<h1>Item Create</h1>
<form action="/order/item" method="post">
@csrf
    <label for="name">商品名</label>
    <input type="text" name="name" id="name">
    <label for="price">価格</label>
    <input type="numbert" name="price" id="price">
    <label for="base">適正数値</label>
    <input type="number" name="base" id="base">

    <input type="submit" value="商品登録">
</form>

<div class="item">
     <table>
          <thead>
               <tr>
                    <th>商品名</th>
                    <th>適正数値/日</th>
                    <th>単価</th>
               </tr>
          </thead>
          <tbody>
          @foreach($items as $item)
               <tr>
                    <th><p>{{$item->name}}</p></th>
                    <th>{{$item->base}}</th>
                    <th>{{$item->prise}}</th>
               </tr>
          @endforeach
          </tbody>
     </table>
</div>

