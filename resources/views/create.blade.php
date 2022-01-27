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
      content: "";
      position: absolute;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      border: solid 0.1rem rgba(0, 0, 0, 0.08);
      background: bottom center repeat-x url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAABfCAMAAAAeT108AAABEVBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABoX7lMAAAAW3RSTlMBCHwGAwQFCgIMCw4PERITFBYXGRoNHR4gISIlJicpKiwuLzEzNDY3OTs8G0BBQ0VGSEpLTU9QUVRVVlhZW11eX2FiZGVmaGlrbG1ucHFyc3R1dnd4eXp7Pn1+eLXrxAAAADRJREFUCFtjYAACDmYGJkYmRiDJAMJMbEzMTP+ZeJgZmTChOFZR7FAPYi71IQMT0JXhTIwAN8YCxDyw89IAAAAASUVORK5CYII=);
    }
    </style> 
@endsection
@section('content')
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ route('index.post.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autofocus>

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
                                    <div id="image-preview"></div>
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
                               <textarea name="content" @error('content') class="is-invalid" @enderror></textarea>
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
                            </div>
                        </div>
                    </form>
                    </form>
                </div>
            </div>
        </div>
                
@endsection

@section('scripts')

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
<script src="{{asset('js/jquery.imagereader-1.1.0.js') }}"></script> 
<script src="https://cdn.jsdelivr.net/npm/bs4-summernote@0.8.10/dist/summernote-bs4.min.js"></script>
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
    </script>
    <script type="text/javascript">
    
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-36251023-1']);
      _gaq.push(['_setDomainName', 'jqueryscript.net']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    
    </script>
@endsection