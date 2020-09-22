<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class orderController extends Controller
{
    public function index() {
        $items = Item::all();
        return view('order.index',['items' => $items]);
    }
}
