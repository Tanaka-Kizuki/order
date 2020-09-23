<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Carbon\Carbon;
use App\Order;
use App\Data;



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
        //発注日時の取得
        $today = new Carbon();
        $daily = $today->format('Y年m月d日');
        $year = $today->year;
        $month = $today->month;
        $day = $today->day;

        // 発注テーブル
        $order = Order::create([
            'today' => $daily,
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'trader' => 'default' 
        ]);

        //発注明細テーブル
        for ($i=1;$i<=5;$i++) {
            $item = Item::where('id',3)->first();
            $data = Data::create([
                'order_id' => $order->id,
                'name' => $datas[$i]['name'],
                'count' => $datas[$i]['count'],
                'total' => $item->prise * $datas[$i]['count'],
            ]);
        }

        return redirect('/');

    }
}
