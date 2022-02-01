@extends('layouts.app')
@section('styles')
    <style>


.cta-100 {
  margin-top: 100px;
  padding-left: 8%;
  padding-top: 7%;
}
.col-md-4{
    padding-bottom:20px;
}

.white {
  color: #fff !important;
}
.mt{float: left;margin-top: -20px;padding-top: 20px;}
.bg-blue-ui {
  background-color: #708198 !important;
}
figure img{width:300px;}

#blogCarousel {
  padding-bottom: 100px;
}

.blog .carousel-indicators {
  left: 0;
  top: -50px;
  height: 50%;
}


/* The colour of the indicators */

.blog .carousel-indicators li {
  background: #708198;
  border-radius: 50%;
  width: 8px;
  height: 8px;
}

.blog .carousel-indicators .active {
  background: #0fc9af;
}




.item-carousel-blog-block {
  outline: medium none;
  padding: 15px;
}

.item-box-blog {
  border: 1px solid #dadada;
  text-align: center;
  z-index: 4;
  padding: 20px;
}

.item-box-blog-image {
  position: relative;
}

.item-box-blog-image figure img {
  width: 100%;
  height: auto;
}

.item-box-blog-date {
  position: absolute;
  z-index: 5;
  padding: 4px 20px;
  top: -20px;
  right: 8px;
  background-color: #41cb52;
}

.item-box-blog-date span {
  color: #fff;
  display: block;
  text-align: center;
  line-height: 1.2;
}

.item-box-blog-date span.mon {
  font-size: 18px;
}

.item-box-blog-date span.day {
  font-size: 16px;
}

.item-box-blog-body {
  padding: 10px;
}

.item-heading-blog a h5 {
  margin: 0;
  line-height: 1;
  text-decoration:none;
  transition: color 0.3s;
}

.item-box-blog-heading a {
    text-decoration: none;
}

.item-box-blog-data p {
  font-size: 13px;
}

.item-box-blog-data p i {
  font-size: 12px;
}

.item-box-blog-text {
  max-height: 100px;
  overflow: hidden;
}

.mt-10 {
  float: left;
  margin-top: -10px;
  padding-top: 10px;
}

.btn.bg-blue-ui.white.read {
  cursor: pointer;
  padding: 4px 20px;
  float: left;
  margin-top: 10px;
}

.btn.bg-blue-ui.white.read:hover {
  box-shadow: 0px 5px 15px inset #4d5f77;
}

    </style>
@endsection
@section('content')
        <div class="container">
            <div class="row blog">
                @if (Auth::user()->posts != null)
                    @foreach (Auth::user()->posts as $post)
                    <div class="col-md-4" >
                        <div class="item-box-blog">
                            <div class="item-box-blog-image">
                            <!--Date-->
                            <div class="item-box-blog-date bg-blue-ui white"> <span class="mon">Augu 01</span> </div>
                            <!--Image-->
                            <figure> <img alt="" src="{{asset("images/".$post->img)}}"> </figure>
                            </div>
                            <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                                <a href="{{route('index.post.edit' , $post)}}" tabindex="0">
                                <h5>{{$post->title}}</h5>
                                </a>
                            </div>
                            <!--Data-->
                            <div class="item-box-blog-data" style="padding: px 15px;">
                                <p><i class="fa fa-user-o"></i>  {{Auth::user()->name}} <i class="fa fa-comments-o"></i></p>
                            </div>
                            <!--Text-->
                            <div class="item-box-blog-text">
                                <p>{!! $post->content !!}</p>
                            </div>
                            <div class="mt"> 
                              <a href="javascript:void" data-route="{{route('index.post.delete' , $post->id)}}" tabindex="0" class="btn bg-blue-ui white delete">Delete</a>
                             </div>
                            <!--Read More Button-->
                            </div>
                        </div>
                    <!--.row-->
                    </div>
                      
                    @endforeach
                @else
                    <div class="alert alert-danger">No Posts Found</div>
                @endif
            </div>
        </div>
                
@endsection
@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
          $(document).on('click' , '.delete' , function(){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.get($(this).data('route') , function(res){
                Swal.fire(
                    'Deleted!',
                    'Your data has been deleted.',
                    'success'
                  )
                  setInterval(() => {
                    window.location = "{{route('index.post.index')}}"
                  }, 2000);
              })
              }
            });
          })
      </script>
      @if (session('success'))
          
      <script>
        Swal.fire(
        'Success',
        '{{session("msg")}}',
        'success'
      )
      </script>
      @endif
@endsection