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

    public function add()
    {
        return view('mypages.add');
    }

    public function create(Request $request)
    {
        //
        return redirect('/');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return view('mypages.edit', compact('item'));
    }

    public function update(Request $request)
    {
        //
        return redirect('/');
    }

    public function destroy($id)
    {
        Item::destroy($id);
        return redirect('/');
    }
}
