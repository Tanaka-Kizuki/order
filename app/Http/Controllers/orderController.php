<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Item;
use App\Order;
use App\Data;



class orderController extends Controller
{
    public function index() {
        return view('order.index');
    }

    public function input() {
        $items = Item::all();
        $today = new Carbon();
        $orderDay = $today->format('Y年m月d日');
        $delivery = Carbon::tomorrow()->format('Y年m月d日');
        return view('order.input',['items' => $items,'orderDay' => $orderDay,'delivery' => $delivery]);
    }

    public function create(Request $request) {
        $datas = $request->all();
        //発注日時の取得
        $today = new Carbon();
        $orderDay = $today->format('Y年m月d日');
        $delivery = Carbon::tomorrow()->format('Y年m月d日');
        $year = $today->year;
        $month = $today->month;
        $day = $today->day;

        // 発注テーブル
        $order = Order::create([
            'today' => $orderDay,
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'shop' => 'default' 
        ]);

        //発注明細テーブル
        for ($i=1;$i<=5;$i++) {
            $item = Item::where('id',$i)->first();
            if(ceil($item->base - $datas[$i]['count']) > 0) {
                $orderCount = ceil($item->base - $datas[$i]['count']);
            } else {
                $orderCount = 0;
            };
            $data = Data::create([
                'order_id' => $order->id,
                'name' => $datas[$i]['name'],
                'count' => $datas[$i]['count'],
                'total' => $item->prise * $orderCount,
                'order_count' => $orderCount,
            ]);
        }
        $order = Order::latest()->first();
        $items = Data::where('order_id',$order->id)->get();

        $totalPrice = 0;
        foreach($items as $item) {
            $totalPrice = $totalPrice + $item->total;
        };

        return view('order.confirmation',['items' => $items,'price' => $totalPrice,'orderDay' => $orderDay,'delivery' => $delivery]);

    }

    public function history() {
        $items = [];
        return view('order.history',['items'=>$items]);
    }

    public function display(Request $request) {
        $select = new Carbon($request->date);
        $orderDay = $select->format('Y年m月d日'); 
        $orders = Order::where('today',$orderDay)->latest()->first();
        $msg = '発注実績がありません';
        //発注実績がある場合のみ表示
        $datas = [];
        if($orders) {
            $datas = Data::where('order_id',$orders->id)->get();
            $msg = '発注日:' . $orderDay;
        }
        return view('order.history',['items'=>$datas, 'msg' => $msg]);
    }
}
