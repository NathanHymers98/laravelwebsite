@extends('template')

@section('content')

	<div class="container">

	<h1>Items</h1>

		@foreach($items as $item)
			<div class="well">
				<h3> {{$item['name']}} </h3>
				<p> {{$item['category']}} </p>
				<p> {{$item['price']}} </p>
				<p> {{$item['department']}} </p>
				<p> {{$item['quantity']}} </p>
				<a href="{{ route('items.show', $item->id) }}"
					class ="btn btn-primary btn-sm">View Details</a>
			@endforeach
		{{$items->links() }}
	</div>

@endsection