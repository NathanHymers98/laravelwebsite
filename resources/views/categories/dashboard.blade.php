    @extends('template')

    @section('content')
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
     <h1>Items</h1>
     <a href="{{action('CategoryController@create')}}" class="btn btn-primary">Create New Category</a>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
      <tr>
        <td>{{$category['id']}}</td>
        <td>{{$category['description']}}</td>
        <td><a href="{{action('CategoryController@edit', $category['id'])}}" 
               class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('CategoryController@destroy', $category['id'])}}" 
                        method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  @endsection
