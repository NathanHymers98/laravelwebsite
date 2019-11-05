@extends('template')

@section('content')

	<div class="container">

	<h1>Categories</h1>

		@foreach($categories as $category)
			<div class="well">
				<h3> {{$category['name']}} </h3>
				<p> {{$category['description']}} </p>
				<a href="{{ route('categories.show', $category->id) }}"
					class ="btn btn-primary btn-sm">View Details</a>
			@endforeach
		{{$categories->links() }}
	</div>

@endsection