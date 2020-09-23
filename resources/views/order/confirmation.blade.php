<h1>Confirmation</h1>
     <table>
          <thead>
               <tr>
                    <th>商品名</th>
                    <!-- <th>単価</th> -->
                    <th>発注数</th>
                    <th>合計金額</th>
               </tr>
          </thead>
          <tbody>
          @foreach($items as $item)
               <tr>
                    <th>{{$item->name}}</th>
                    <th>{{$item->order_count}}</th>
                    <th>{{$item->total}}</th>
               </tr>
          @endforeach
          </tbody>
          <input type="submit" value="内容確認">
     </table>
