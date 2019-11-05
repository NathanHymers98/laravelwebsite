@extends('template')

@section('content')

    <div class="container">

        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="img/img1.png" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="chicago.jpg" alt="Chicago">
    </div>

    <div class="item">
      <img src="ny.jpg" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

        <h2>Chris Computer Shop</h2>

        <div class="row">
            <div class="col-md-8" >
                <form action="search" method ="get" role="search">
                    {{csrf_field() }}
                <input type="text" class ="form-control" name="search" placeholder="Search items" title="Enter keywords to search for item">
                </form>
            </div>
            <div class="col-md-2">
                <span class="input-group-btn">
                <button type="submit" class ="btn btn-info" title="Click this button to start search">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>
        </div>

     

        @foreach ($items->chunk(4) as $items)
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption text-center">
                                <a href="{{ url('shop', [$item->slug]) }}"><img src="{{ asset('img/' . $item->image) }}" alt="item" class="img-responsive"></a>
                                <a href="{{ url('shop', [$item->slug]) }}">
                                <h3>{{ $item->name }}</h3>
                                <p>{{ $item->category }}</p>
                                <p>{{ $item->price }}</p>
                                <p>{{ $item->description }}</p>
                                <p>{{ $item->quantity }}</p>
                                </a>
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

    </div> <!-- end container -->

@endsection