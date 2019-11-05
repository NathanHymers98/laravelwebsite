<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
			data-target="#bs-example-navbar-collapse-1" aria-expanded="flase">
				<span class="sr-only">Toggle navigation></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">ChrisComputerShop</a>
		</div>
	

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('index')}}">Home</a></li>
                <li><a href="{{action('ProductController@index')}}" class="btn ">Product</a></li>
                <li><a href="{{action('QuestionController@index')}}" class="btn ">Question</a></li>
                <li><a href="{{route('about')}}">About</a></li>
                <li><a href="{{route('contact')}}">Contact</a></li>
                <li><a href="{{action('ItemController@index')}}" class="btn ">Item</a></li>
                <li><a href="{{action('CategoryController@index')}}" class="btn ">Category</a></li>

			</ul>

			<ul class="nav navbar-nav navbar-right">
                <a href="#" class="btn btn-primary" style="margin-top:5px;">Ask A Question</a>
			</ul>
		</div>
	</div>
</nav>