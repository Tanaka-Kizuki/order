<h1>Order</h1>
<form action="/order">
@csrf
     @foreach($items as $item)
     <label for="{{$item->eng}}">{{$item->name}}</label>
     <input type="hidden" name="name" value="{{$item->name}}">
     <input type="text" name="{{$item->name}}" id="{{$item->eng}}">
     @endforeach
</form>