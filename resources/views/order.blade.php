<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">
    <title>Order details </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

  </head>

  <body>
    <div class="container">
      <h2>Enter order detials</h2><br  />
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br />
      @endif
      @if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
      </div><br />
      @endif

      <form method="post" action="{{url('storeorder')}}">
      	{{csrf_field()}}
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="orderdate">Order Date:</label>
            <input type="text" class="form-control" name="orderdate" placeholder="Enter Order date">
          </div>
        </div>

         <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Enter username">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="firstname">First name:</label>
              <input type="text" class="form-control" name="firstname" placeholder="Enter First name">
            </div>
          </div>

           <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="lastname">Last name:</label>
            <input type="text" class="form-control" name="lastname" placeholder="Enter Last name">
          </div>
        </div>

         <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="address">Address:</label>
              <input type="text" class="form-control" name="address" placeholder="Enter Address">
            </div>
          </div>

          <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="city">City:</label>
              <input type="text" class="form-control" name="city" placeholder="Enter City/Town">
            </div>
          </div>

          <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="county">County:</label>
              <input type="text" class="form-control" name="county" placeholder="Enter County">
            </div>
          </div>

          <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="postalcode">Post code:</label>
              <input type="text" class="form-control" name="postalcode" placeholder="Enter Post code">
            </div>
          </div>

          <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="telephone">Telephone number:</label>
              <input type="text" class="form-control" name="telephone" placeholder="Enter telephone number">
            </div>
          </div>

          <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" placeholder="Enter email address">
            </div>
          </div>

          <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="total">Total:</label>
              <input type="text" class="form-control" name="total" placeholder="Enter Order total">
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success" title="Click to save order" style="margin-left:38px">Create Order</button>
          </div>
        </div>
      </form>
  </body >
</html >

