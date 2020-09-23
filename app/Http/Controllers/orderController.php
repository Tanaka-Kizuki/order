<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class orderController extends Controller
{
    public function index() {
        $items = Item::all();
        return view('order.index',['items' => $items]);
    }

    public function create(Request $request) {
        $datas = $request->all();
        for ($i=1;$i<=5;$i++) {
            $data[$i-1]=$datas[$i]['count'];
        }
        echo '<pre>';
        var_dump($datas);
        echo '</pre>';
    }
}
