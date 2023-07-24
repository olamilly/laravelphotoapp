@extends("layouts.app")
@section("content")
<html>
<head>
<style>
    #container{
        text-align:center;
        display:flex;
        flex-direction:column;
        align-items:center;
    }
    form{
        width:45%;
        margin-top:1rem;
    }
</style>
</head>
<body>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery.js"></script>
  <!-- Include all compiled plugins (below), or include individual files 
        as needed -->
  <script src="js/bootstrap.min.js"></script>
<div id="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h1>Edit {{ $name }}</h1>
    <form method="post" action="{{route('updateuser')}}">
    <input type=hidden name=id value="{{ $id }}">
{{ csrf_field() }}
<div class="form-group row my-2" >
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" Value="{{ $name }}">
    </div>
  </div>
  <div class="form-group row my-2">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" name="email" class="form-control" Value="{{ $email }}">
    </div>
  </div>
 
  <div class="form-group text-center">
    <button type="submit" class="btn btn-primary align-self-center">Update</button>
</div>
</form>
</div>

</body>
</html>
@endsection



