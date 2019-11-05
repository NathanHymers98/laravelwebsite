@extends('template')

	@section('content')
		<div class="container">
			<h1>{{$item['id']}}</h1><br />
			<p class ="lead">
				{{$item['name']}}</p>
			<p>{{$item['category']}}</p>
			<p>{{$item['price']}}</p>
			<p>{{$item['description']}}</p>
			<p>{{$item['quantity']}}</p>
		</div>
<hr/ >
@endsection