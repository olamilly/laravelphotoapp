@extends("layouts.app")
@section("content")
<html>
<head>
    <style>
        #container{
            text-align:center;
            min-height:650px;
        }
        .modal-header{
            text-align:center;
            justify-content:center;
        }
        #btn-group{
          display:flex;
          align-items:center;
          justify-content: center;
        }
        #links{
          width:100%;
          display:flex;
          justify-content:center;
        }
        h1{
            margin-bottom:5px;
        }
        .inactive{
          display:none;
        }
        section{
          border:1px solid grey;
          border-radius:3px;
          width:30%;
          margin:10px;
          margin:10px;
          min-width:250px;
        }
        #username{
          margin-bottom:0;
        }
    </style>
</head>
<body>
<div id="container">
@if(session()->has('error'))
    <div style="width:100%; display:flex; justify-content:center">
    <div class="card" style="width:30%">
  <div class="card-header">
    Success
    <box-icon id=closeCard name='x' style="position:absolute; right:0; height:25px"></box-icon>
  </div>
  <div class="card-body">
    {{ session()->get('error')}}
  </div>
</div></div>
    @endif
    @if(session()->has('success'))
    <div style="width:100%; display:flex; justify-content:center">
    <div class="card" style="width:30%">
  <div class="card-header">
    Success
    <box-icon id=closeCard name='x' style="position:absolute; right:0; height:25px"></box-icon>
  </div>
  <div class="card-body">
    {{ session()->get('success')}}
  </div>
</div></div>
    @endif
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h1>Olamilly Photo App</h1>
    @if(Auth::User())
    <h3>Welcome, {{ Auth::user()->name }}</h3>
    @endif
    
    @foreach($posts as $post)
    <section>
    <div style="background-color:lightgrey; display:flex; align-items:center; padding:5px; margin:1px;">
    <box-icon type='solid' name='user-circle'></box-icon>
      <a href="{{ route('profile', ['id'=>$post->user_id]) }}" style="width:100%" ><p id="username"><span>@</span>{{ $post->username }}</p></a></div>
      <img src="{{ url('public/Image/'.$post->image) }}" style="height: 200px; width: 250px;" />
      <p id="caption" style="background-color:grey; margin-top:1rem">{{ $post->caption}}</p>
      <form class="captionForm inactive" id="{{$post->id}}" method="post" action="{{route('updated')}}">
            {{ csrf_field() }}
            <input name="id" type=hidden value="{{$post->id}}" />
      <input name="newCaption" type=text placeholder="Enter New Caption"/>
      <input type=submit value=Edit />
      </form>
      @if(Auth::User())
      @if( $post->user_id == Auth::User()->id)
      <div id="btn-group" style="display:flex; align-items:center; justify-content:center;">
            <p id=itemid class=inactive>{{$post->id}}</p>
            <a data-bs-toggle="modal" data-bs-target="#exampleModal"><box-icon name='trash' style="cursor: pointer; margin:.5rem"></box-icon></a>
            <a class=edit id="{{$post->id}}" ><box-icon name='pencil' style="cursor: pointer; margin:.5rem"></box-icon></a>
      </div>
      @endif
      @endif
      <p id=date>Posted on: {{@substr($post->created_at,0,10)}}</p>
    </section>
    
    

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-center" id="exampleModalLabel">Are you sure?</h5>
      </div>
      
      <form method="post" action="{{route('delete')}}">
            {{ csrf_field() }}
            <div class="modal-body">
                This post will be permanently deleted from the database and cannot be recovered.
            </div>
            <div class="modal-footer">
                <input type=hidden id=delitemid name=post_id />
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endforeach
<!--PAGINATION-->
<div id="links">
  {{ $posts->links('vendor.pagination.bootstrap-5') }}
</div>
</div>
<script>
  
    var boxList = document.querySelectorAll(".myBtn");
      boxList.forEach(box => {
        box.addEventListener('click', function b(){boxOperation(this)});
      });
    function boxOperation(e){
        var val= e.closest('#btn-group').children[0].innerText;
        document.getElementById("delitemid").value=val;  
    }
  var sl = document.querySelectorAll(".edit");
  var dl = document.querySelectorAll(".captionForm");
      sl.forEach(box => {
        box.addEventListener('click', function b(){so(this)});
      });
    function so(e){
        dl.forEach(d =>{
          if (d.id.value==e.id){
            d.classList.toggle("inactive");
          }
        })
    }
    document.getElementById("closeCard").style.cursor="pointer";
  document.getElementById("closeCard").addEventListener('click', ()=>{
    document.querySelector(".card").style.display="none";
  })
</script>
</body>
</html>
@endsection



