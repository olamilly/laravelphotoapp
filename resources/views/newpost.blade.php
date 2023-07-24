@extends("layouts.app")
@section("content")
<html>
<head>
    <style>
        h1{
            text-align:center;
        }
        form{
            display:flex;
            flex-direction:column;
            align-items:center;
        }
        form>div{
            margin:5px;
            display:flex;
            flex-direction:column;
            width:40%;
        }
        input{
            padding:.5rem;
            border-radius:5px;
        }
        button{
            margin:5px;
        }
        #content{
            border:1px solid lightgrey; 
            border-radius:5px;
            display:flex; 
            margin-top:0px;
            flex-direction:column; 
            justify-content:space-around;
            align-items:center;
            padding:.7rem;
            min-height:250px;
        }
        #content>div{
            width:100%;
        }
    </style>
</head>
<body>
@if($errors->any())
<div style="width:100%; display:flex; justify-content:center">
    <div class="card" style="width:30%">
  <div class="card-header">
    Errors <box-icon id=closeCard name='x' style="position:absolute; right:0; height:25px"></box-icon>
  </div>
  <div class="card-body">
    <ul>
      @foreach($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
</div></div>
    @endif
<div id="container">
    <a href="{{ url('/') }}"><box-icon name='arrow-back'></box-icon></a>
    <h1>Form</h1>
    <form method="post" action="{{route('savepost')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div>
        <label for="name">Username</label>
        <input name="username" value="{{ Auth::user()->name }}"/></div>

        <label style="width:40%; margin-top:1rem">Content</label>
        <div id="content">
        <div>
            <label for="image" class="form-label" style="width:100%;">Image File</label>
            <input class="form-control form-control-sm mb-2" name="image" id="formFileSm" type="file">
        </div>
        <div>
            <label for="caption" style="width:100%;">Caption</label>
            <input name="caption" style="width:100%"/>
        </div>
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
  document.getElementById("closeCard").style.cursor="pointer";
  document.getElementById("closeCard").addEventListener('click', ()=>{
    document.querySelector(".card").style.display="none";
  })
</script>
</body>
</html>
@endsection