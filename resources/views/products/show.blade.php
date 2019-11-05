@extends('template')

	@section('content')
		<div class="container">
			<h1>{{$product['id']}}</h1><br />
			<p class ="lead">
				{{$product['name']}}
			</p>
			<p>{{$product['price']}}</p>
		</div>
<hr/ >
@endsection