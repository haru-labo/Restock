<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Carbon\Carbon;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->input;
        $items = [];
        if (!empty($input)) {
            $items = Item::where('category', 'like', '%'.$input.'%')->get();
        } else {
            $items = Item::all();
        }
        return view('mypages.index', compact('items', 'input'));
    }

    public function create()
    {
        return view('mypages.create');
    }

    public function store(Request $request)
    {
        $request['datelastopen'] = $request['dateopen'];
        $this->validate($request, Item::$rules);
        $item = new Item;
        $form = $request->all();
        unset($form['_token']);
        $item->fill($form)->save();
        return redirect('/')->with('flash_message', $item['name'].'を追加しました！');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return view('mypages.edit', compact('item'));
    }

    public function update(Request $request)
    {
        $this->validate($request, Item::$rules);
        $item = Item::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $item->fill($form)->save();
        return redirect('/')->with('flash_message', $item['name'].'を更新しました！');
    }

    public function destroy($id)
    {
        $item=Item::find($id);
        Item::destroy($id);
        return redirect('/')->with('flash_message', $item['name'].'を削除しました。');
    }

    public function open($id)
    {
        $openItem = Item::find($id);
        if ($openItem['stock'] <= 0) {
            return redirect('/')->with('flash_message', $openItem['name'].'のストック数が０です(><)!!');
        }
        $openItem['stock'] -= 1;
        $openItem['datelastopen'] = $openItem['dateopen'];
        $openItem['dateopen'] = Carbon::now();
        $openItem->save();
        return redirect('/')->with('flash_message', $openItem['name'].'を開封しました!');
    }

    public function restock($id)
    {
        $item = Item::find($id);
        if ($item['stock'] >= 999) {
            return redirect('/')->with('flash_message', $item['name'].'にこれ以上ストックを追加できません！');
        }
        $item['stock'] += 1;
        $item->save();
        return redirect('/')->with('flash_message', $item['name'].'のストックを1つ追加しました！');
    }
}
