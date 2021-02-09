@extends('layouts.backend.app')

@section('tittle')
    Post
@endsection

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    {{--    <link href="{{ asset('assets/backend/css/samples.css')}}" rel="stylesheet">--}}

@endpush

@section('content')

    <div class="container-fluid">
        <form action="{{ route('admin.post.update',$post->id) }}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('put')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit Post
                            </h2>
                        </div>
                        <div class="body">

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" class="form-control" name="title" value="{{$post->tittle }}">
                                    <label class="form-label">Post title</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image">Featured Image</label>
                                <input type="file" name="image">
                            </div>
                            <br>

                            <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in" name="status" value="1" {{ $post->status == true ? 'checked' : "" }}>
                                <label for="publish">Published </label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Category & Posts
                            </h2>
                        </div>
                        <div class="body">

                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('categories' ?'focused error' : '') }} ">
                                    <label for="category" class="">Select Category</label>
                                    <select name="categories[]" id="category" class="form-control show-tick" data-live-search="false" multiple>
                                        @foreach($categories as $category)
                                            <option
                                                @foreach($post->categories as $postCategory)
                                                    {{ $postCategory->id == $category->id ? "selected" : "" }}
                                                @endforeach
                                                value="{{ $category->id }}"> {{ $category->name }} </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags' ?'focused error' : '') }}">
                                    <label for="tag" class="">Select Tag</label>
                                    <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="false" multiple>
                                        @foreach($tags as $tag)
                                            <option
                                                @foreach($post->tags as $postTag)
                                                {{ $postTag->id == $tag->id ? "selected" : "" }}
                                                @endforeach
                                                value="{{ $tag->id }}"> {{ $tag->name }} </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <br>
                            <a  href="{{route('admin.post.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Multi Column -->


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Body
                            </h2>
                        </div>
                        <div class="body">
                        <textarea cols="70" rows="10" id="editor" name="body" >
                            {{ $post->body }}
                        </textarea>
{{--                            <textarea name="" id="" ></textarea>--}}
                            {{--                        <div id="editor">--}}
                            {{--                            <h1>Hello world!</h1>--}}
                            {{--                            <p>I'm an instance of <a href="https://ckeditor.com">CKEditor</a>.</p>--}}
                            {{--                        </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Multi Column -->
        </form>
    </div>

@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Multi Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <!-- Tyne Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>

    <script>
        $(function () {
            //CKEditor
            CKEDITOR.replace('ckeditor');
            CKEDITOR.config.height = 300;

            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            {{--tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce')}}';--}}
                tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });
    </script>

    <script>
        initSample();
    </script>

@endpush
