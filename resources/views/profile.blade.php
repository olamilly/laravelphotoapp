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
        .inactive{
          display:none;
        }
        section{
          border:1px solid grey;
          border-radius:3px;
          width:30%;
          margin:10px;
          min-width:360px;
        }
        #username{
          width:100%; 
          margin-bottom:0;
        }
        p#caption{
          margin-top:0px;
        }
    </style>
    
</head>
<body>
<div id="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
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
    @if(Auth::User())
    @if(Auth::User()->id == $id)
    <h1><span>@</span>{{ Auth::user()->name }}</h1>
    <p>{{  Auth::user()->email }}</p>
    
    
    <div id="btn-group">
        <a href="{{route('edituser', ['id'=>Auth::user()->id])}}"><button class="btn btn-primary ">Edit Profile</button></a>
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete Profile</button>
    </div>
   
    <hr>
    
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-center" id="exampleModalLabel">Are you sure?</h5>
      </div>
      <div class="modal-body">
        Your profile will be permanently deleted from the database and cannot be recovered.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{ route('deleteuser', ['id'=>Auth::user()->id]) }}"><button type="button" class="btn btn-danger">Confirm Delete</button></a>
      </div>
    </div>
  </div>
</div>
@endif
@endif
<div>
        <h1><span>@</span>{{ $username }} Posts</h1>
    </div>
@for($i = $len-1; $i >=0; $i--)
    <section style="text-align: center">
      <div style="background-color:lightgrey; display:flex; align-items:center; padding:5px; margin:1px;">
      <box-icon type='solid' name='user-circle'></box-icon>
      <p id="username"><span>@</span>{{ $yourPosts[$i]->username }}</p>
      </div>
      <img src="{{ url('storage/'.$yourPosts[$i]->image) }}" style="height: 350px; width: 350px;" />
      @if(substr($yourPosts[$i]->image,0,6)!="upload")
      <p style="margin-bottom:0;">Image downloaded from <span style="color:grey">pixabay.com</span></p>
      <p id="caption" style="background-color:lightgrey">Caption: {{ $yourPosts[$i]->caption}} {{@substr($yourPosts[$i]->created_at,11,8)}}</p>
      @else
      <p style="margin-bottom:0;">Image uploaded by user locally</p>
      <p id="caption" style="background-color:lightgrey">Caption: {{ $yourPosts[$i]->caption}}</p>
      @endif
      <form class="captionForm inactive" id="{{$yourPosts[$i]->id}}" method="post" action="{{route('updated')}}">
            {{ csrf_field() }}
            <input name="id" type=hidden value="{{$yourPosts[$i]->id}}" />
      <input name="newCaption" type=text placeholder="Enter New Caption"/>
      <input type=submit value=Edit />
      </form>
      @if(Auth::User())
      @if(Auth::User()->id == $yourPosts[$i]->user_id)
      <div id="btn-group" style="display:flex; align-items:center; justify-content:center;">
            <p id=itemid class=inactive>{{$yourPosts[$i]->id}}</p>
            <a data-bs-toggle="modal" data-bs-target="#exampleModal2"><box-icon name='trash' style="cursor: pointer; margin:.5rem"></box-icon></a>
            <a class=edit id="{{$yourPosts[$i]->id}}" ><box-icon name='pencil' style="cursor: pointer; margin:.5rem"></box-icon></a>
      </div>
      @endif
      @endif
      <p id=date>Posted on: {{@substr($yourPosts[$i]->created_at,0,10)}}</p>
    </section>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@endfor
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



