<h1>hello</h1>
@foreach ($res as $item)
<p>{{$item->title}}</p>
<img src="{{$item->photoURL}}" alt="">
@endforeach