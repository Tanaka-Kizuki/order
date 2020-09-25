<h1>Item Create</h1>
<form action="/order/item" method="post">
@csrf
    <label for="name">商品名</label>
    <input type="text" name="name" id="name">
    <label for="price">価格</label>
    <input type="text" name="price" id="price">
    <label for="base">適正数値</label>
    <input type="text" name="base" id="base">

    <input type="submit" value="商品登録">
</form>

