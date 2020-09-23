<h1>Order</h1>
<form action="/order" method="post">
@csrf
     <table>
          <thead>
               <tr>
                    <th>商品名</th>
                    <th>適正数値/日</th>
                    <th>単価</th>
                    <th>在庫</th>
               </tr>
          </thead>
          <tbody>
          @foreach($items as $item)
               <tr>
                    <th><label for="{{$item->eng}}">{{$item->name}}</label></th>
                    <th>{{$item->base}}</th>
                    <th>{{$item->prise}}</th>
                    <th><input type="number" name="{{$item->id}}[count]"></th>
                    <input type="hidden" name="{{$item->id}}[name]" value="{{$item->name}}">
               </tr>
          @endforeach
          </tbody>
          <input type="submit" value="内容確認">
     </table>
</form>