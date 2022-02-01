@extends('layouts.app')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.11/dist/summernote-bs4.min.css" rel="stylesheet">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<style>
    .drop { background-color: #fff; }
    
    .drop:after { border: dashed 0.3rem rgba(0, 0, 0, 0.0875); }
    
    .drop .drop-label { color: rgba(0, 0, 0, 0.0875); }
    
    .drop:hover:after { border-color: rgba(0, 0, 0, 0.125); }
    
    .drop:hover .drop-label { color: rgba(0, 0, 0, 0.125); }
    
    #image-preview, .image-preview { background-color: #000; }
    
    .drop {
      min-width: 200px;
      min-height: 10rem;
      position: relative;
      overflow: hidden;
      cursor: pointer;
      margin: 0;
    }
    
    .drop:after {
      content: "";
      position: absolute;
      top: 0;
      right: 0;
      left: 0;
      bottom: 0;
    }
    
    .drop.file-focus { border: 0; }
    
    .drop:hover { cursor: pointer; }
    
    .drop .drop-label {
      font-size: 2.4rem;
      font-weight: 300;
      line-height: 4rem;
      width: 32rem;
      text-align: center;
      position: absolute;
      top: 50%;
      margin-top: -1.5rem;
      left: 50%;
      margin-left: -16rem;
    }
    
    .drop input[type=file] {
      line-height: 50rem;
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      height: 100%;
      width: 100%;
      opacity: 0;
      z-index: 10;
      cursor: pointer;
    }
    
    #image-preview, .image-preview {
      width: 100%;
      display: block;
      position: relative;
      z-index: 1;
    }
    
    #image-preview:empty, .image-preview:empty { display: none; }
    
    #image-preview img, .image-preview img {
      display: block;

      margin: 0 auto;
      width: 100%
    }
    
    #image-preview:after, .image-preview:after {
        background: url('{{asset("images/".$post->img)}}');
      content: "";
      position: absolute;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      border: solid 0.1rem rgba(0, 0, 0, 0.08);
    }
            </style> 
@endsection
@section('content')
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ route('index.post.update' , $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$post->title}}" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="img" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <div class="drop">
                                    <div class="uploader">
                                      <label class="drop-label">Drag and drop images here</label>
                                      <input type="file" class="image-upload" id="photo" name="img" accept="image/*">
                                    </div>
                                    <div id="image-preview" style="background:url('{{asset("images/".$post->img)}}')"></div>
                                  </div>
                               
                                @error('img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="content" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                               <textarea name="content" @error('content') class="is-invalid" @enderror>{!! $post->content !!}</textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <button type="button" class="btn btn-danger delete">
                                  {{ __('Delete') }}
                              </button>
                            </div>
                        </div>
                    </form>

                    <form action="{{route('index.post.destroy' , $post->id)}}" method="post" id="destroy">
                      @csrf
                      @method('delete')
                      <input type="submit" class="d-none">
                    </form>
                </div>
            </div>
        </div>
                
@endsection

@section('scripts')

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
<script src="{{asset('js/jquery.imagereader-1.1.0.js') }}"></script> 
<script src="https://cdn.jsdelivr.net/npm/bs4-summernote@0.8.10/dist/summernote-bs4.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('textarea').summernote({
            height: 300,   //set editable area's height
        });
    });
</script>
<script>
    $(document).ready(function(){
            $('#photo').imageReader({
              renderType: 'canvas',
              onload: function(canvas) {
                var ctx = canvas.getContext('2d');
                ctx.fillStyle = "orange";
                ctx.font = "12px Verdana";
                ctx.fillText("Filename : "+ this.name, 10, 20, canvas.width - 10);
                $(canvas).css({
                  width: '100%',
                  marginBottom: '-10px'
                });
              }
            });
          });
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
              $.ajax({
                url: $('#destroy').attr('action'),
                method: $('#destroy').attr('method'),
                processData: false,
                contentType: false,
                cache: false,
                data : new FormData($('#destroy')[0]),
                success:function(result){
                  Swal.fire(
                    'Deleted!',
                    'Your data has been deleted.',
                    'success'
                  )
                  setInterval(() => {
                    window.location = "{{route('index.post.index')}}"
                  }, 2000);
                },error: function(jqXhr, textStatus, errorMessage){
                    // console.log("Error: ", errorMessage.());
                }
              });
            }
          })
      })
    </script>
@endsection