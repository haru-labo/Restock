<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Carbon\Carbon;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $searchWord = $request->searchWord;
        $items = [];
        if (!empty($searchWord)) {
            $items = Item::where('category', 'like', '%'.$searchWord.'%')->paginate(7);
        } else {
            $items = Item::orderBy('stock', 'asc')
            ->orderBy('dayperstock', 'asc')
            ->orderBy('dateopen', 'asc')
            ->paginate(7);
        }
        return view('mypages.index', compact('items', 'searchWord'));
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
        $item->fill($form)->setDayPerStock()->save();
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
        $item->fill($form)->setDayPerStock()->save();
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
        $item = Item::find($id);
        if ($item->stock <= 0) {
            return redirect('/')->with('flash_message', $item['name'].'のストック数が０です(><)!!');
        }
        $item->fill([
            'stock' => $item->stock -= 1,
            'datelastopen' => $item->dateopen,
            'dateopen' => Carbon::now(),
            ])->setDayPerStock()->save();
        return redirect('/')->with('flash_message', $item['name'].'を開封しました!');
    }

    public function restock($id)
    {
        $item = Item::find($id);
        if ($item->stock >= 999) {
            return redirect('/')->with('flash_message', $item['name'].'にこれ以上ストックを追加できません！');
        }
        $item->fill([
            'stock' => $item->stock += 1
            ])->save();
        return redirect('/')->with('flash_message', $item['name'].'のストックを1つ追加しました！');
    }
}
