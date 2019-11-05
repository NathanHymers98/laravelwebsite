@extends('template')

@section('content')

	<div class="container">

	<h1>Products</h1>

		@foreach($products as $product)
			<div class="well">
				<h3> {{$product['name']}} </h3>
				<p> {{$product['price']}} </p>
				<a href="{{ route('products.show', $product->id) }}"
					class ="btn btn-primary btn-sm">View Details</a>
			@endforeach
		{{$products->links() }}
	</div>

@endsection