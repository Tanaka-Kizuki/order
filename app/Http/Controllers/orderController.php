<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Item;
use App\Order;
use App\Data;
use Illuminate\Support\Facades\Auth;



class orderController extends Controller
{
    public function index() {
        return view('order.index',['user' => Auth::user()]);
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
        unset($datas['_token']);
        //発注日時の取得
        $today = new Carbon();
        $orderDay = $today->format('Y年m月d日');
        $delivery = Carbon::tomorrow()->format('Y年m月d日');
        $year = $today->year;
        $month = $today->month;
        $day = $today->day;

        // 発注テーブル
        $oldOrder = Order::latest()->first();
        if($oldOrder) {
            if($oldOrder->today == $orderDay) {
                $oldOrder->fill($datas)->save();
            } else {
                $order = Order::create([
                    'today' => $orderDay,
                    'year' => $year,
                    'month' => $month,
                    'day' => $day,
                    'shop' => 'default' 
                ]); 
            }
        } else {
            $order = Order::create([
                    'today' => $orderDay,
                    'year' => $year,
                    'month' => $month,
                    'day' => $day,
                    'shop' => 'default' 
            ]);
        }

        $order = Order::latest()->first();

        //発注明細テーブル
        $oldData = Data::latest()->first();
        for ($i=1;$i<=Item::count();$i++) {
            $item = Item::where('id',$i)->first();

            //在庫数より発注数の計算
            if(ceil($item->base - $datas[$i]['count']) > 0) {
                $orderCount = ceil($item->base - $datas[$i]['count']);
            } else {
                $orderCount = 0;
            };

            //1日一回のみ発注可能
            if($oldData) {
                if($oldData->order_id != $oldOrder->id) {
                    $data = Data::create([
                        'order_id' => $order->id,
                        'name' => $datas[$i]['name'],
                        'count' => $datas[$i]['count'],
                        'total' => $item->prise * $orderCount,
                        'order_count' => $orderCount,
                    ]);
                    $msg = '発注が確定しました';
                } else {
                    $msg = 'すでに発注済みです';
                }
            } else {
                $data = Data::create([
                    'order_id' => $order->id,
                    'name' => $datas[$i]['name'],
                    'count' => $datas[$i]['count'],
                    'total' => $item->prise * $orderCount,
                    'order_count' => $orderCount,
                ]);
                $msg = '発注が確定しました';
            }
        }

        //最新の発注(現在入力)データ取得
        $items = Data::where('order_id',$order->id)->get();

        //発注合計金額を計算
        $totalPrice = 0;
        foreach($items as $item) {
            $totalPrice = $totalPrice + $item->total;
        };

        $param = ['items' => $items,'price' => $totalPrice,'orderDay' => $orderDay,'delivery' => $delivery,'msg' => $msg];

        return view('order.confirmation',$param);

    }

    //発注履歴
    public function history() {
        $items = [];
        $msg = '発注履歴';
        return view('order.history',['items'=>$items, 'msg' => $msg]);
    }

    public function display(Request $request) {
        $select = new Carbon($request->date);
        $orderDay = $select->format('Y年m月d日');
        $orderDayTomorrow = $select->tomorrow()->format('Y年m月d日');
        $orders = Order::where('today',$orderDay)->latest()->first();
        $msg = '発注実績がありません';
        //発注実績がある場合のみ表示
        $datas = [];
        if($orders) {
            $datas = Data::where('order_id',$orders->id)->get();
            $msg = '発注日:' . $orderDay .' 納品日' . $orderDayTomorrow;
        }
        return view('order.history',['items'=>$datas, 'msg' => $msg]);
    }

    //商品設定
    public function item() {
        $items = Item::all();
        return view('order.item',['items' => $items]);
    }

    public function itemCreate(Request $request) {
        $form = $request->all();
        unset($form['_token']);
        Item::create([
            'name' => $request->name,
            'prise' => $request->price,
            'base' => $request->base
        ]);
        return redirect('/order/item');
    }

    public function itemEdit(Request $request) {
        $form = Item::find($request->id);
        return view('order.itemedit',['form'=>$form]);
    }

    public function itemUpdate(Request $request) {
        Item::where('id',$request->id)
          ->update(['name' => $request->name,'prise' => $request->prise,'base' => $request->base]);
        return redirect('/order/item');
    }
}
