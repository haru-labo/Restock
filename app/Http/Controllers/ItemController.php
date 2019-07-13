<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

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
        return redirect('/');
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
        return redirect('/');
    }

    public function destroy($id)
    {
        Item::destroy($id);
        return redirect('/');
    }
}
