<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;
use Carbon\Carbon;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $searchWord = $request->searchWord;
        $items = [];
        if (!empty($searchWord)) {
            $items = $user
                ->items()
                ->where('category', 'like', '%' . $searchWord . '%')
                ->orWhere('name', 'like', '%' . $searchWord . '%')
                ->orderBy('stock', 'asc')
                ->orderBy('dayperstock', 'asc')
                ->orderBy('dateopen', 'asc')
                ->paginate(7);
        } else {
            $items = $user
                ->items()
                ->orderBy('stock', 'asc')
                ->orderBy('dayperstock', 'asc')
                ->orderBy('dateopen', 'asc')
                ->paginate(7);
        }

        $items->each(function ($item) {
            $item->setRemainingDays();
        });

        return view('mypages.index', compact('items', 'searchWord', 'user'));
    }

    public function create()
    {
        return view('mypages.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request['datelastopen'] = $request['dateopen'];
        $this->validate($request, Item::$rules);
        $item = new Item;
        $form = $request->all();
        unset($form['_token']);
        $item->fill($form)->setDayPerStock();
        $user->items()->save($item);
        return redirect()->route('item.index')->with('flash_message', $item['name'] . 'を追加しました！');
    }

    public function edit($id)
    {
        $item = Auth::user()->items()->find($id);
        return view('mypages.edit', compact('item'));
    }

    public function update(Request $request)
    {
        $this->validate($request, Item::$rules);
        $item = Item::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $item->fill($form)->setDayPerStock()->save();
        return redirect()->route('item.index')->with('flash_message', $item['name'] . 'を更新しました！');
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        Item::destroy($id);
        return redirect()->route('item.index')->with('flash_message', $item['name'] . 'を削除しました。');
    }

    public function open($id)
    {
        $item = Item::find($id);
        if ($item->stock <= 0) {
            return redirect()->route('item.index')->with('flash_message', $item['name'] . 'のストック数が０です(><)!!');
        }
        $item->fill([
            'stock' => $item->stock -= 1,
            'datelastopen' => $item->dateopen,
            'dateopen' => Carbon::now(),
        ])->setDayPerStock()->save();
        return redirect()->route('item.index')->with('flash_message', $item['name'] . 'を開封しました!');
    }

    public function restock($id)
    {
        $item = Item::find($id);
        if ($item->stock >= 999) {
            return redirect()->route('item.index')->with('flash_message', $item['name'] . 'にこれ以上ストックを追加できません！');
        }
        $item->fill([
            'stock' => $item->stock += 1
        ])->save();
        return redirect()->route('item.index')->with('flash_message', $item['name'] . 'のストックを1つ追加しました！');
    }
}
