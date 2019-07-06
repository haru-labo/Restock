<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    public function index() {
        $items = Item::all();
        $input = '';
        return view('mypages.index', compact('items','input'));
    }

    public function categorySearch(Request $request) {
        $input = $request->input;
        $items = Item::where('category', 'like', '%'.$input.'%')->get();
        return view('mypages.index', compact('items', 'input'));
    }
}
