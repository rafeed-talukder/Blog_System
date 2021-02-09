@extends('layouts.frontend.app')

@section('tittle')
    {{ $post->tittle }}
@endsection

@push('css')
    <link href="{{ asset('assets/frontend/css/single-page/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/single-page/responsive.css') }}" rel="stylesheet">

    <style>
        .header-bg{
            width: 100%;
            height: 200px;
            background-image: url("{{ asset('storage/post/'.$post->image) }}");
            background-size: cover;

        }
        .favorite_posts{
            color: #0D47A1;
        }
    </style>

@endpush

@section('content')
    <div class="header-bg">
        <div class="display-table  center-text">
            <h1 class="title display-table-cell"><b>DESIGN</b></h1>
        </div>
    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{ asset('storage/profile/'.$post->user->image) }}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b> {{ $post->user->name }} </b></a>
                                    <h6 class="date">on - {{ $post->created_at->diffForHumans() }}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="#"><b>{{ $post->tittle }}</b></a></h3>

{{--                            <p class="para"> {{ $post->body }} </p>--}}

                            <div class="para">
                                {!! html_entity_decode( $post->body ) !!}
                            </div>


                            <ul class="tags">
                                @foreach($post->tags as $tag)
                                    <li><a href="#"> {{ $tag->name }} </a></li>
                                @endforeach
                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
                                <li>
                                    @guest
                                        <a href="javascript:void(0);" onclick="toastr.info('To add favorite list,You need to login first','Info',{
                                                    closeButton:true,
                                                    progressBar:true,
                                                })" ><i class="ion-heart"></i>
                                            {{ $post->favorite_to_users->count() }}
                                        </a>
                                    @else
                                        <a class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count() == 0 ? 'favorite_posts' : ' ' }}" href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{$post->id}}').submit();" ><i class="ion-heart"></i>
                                            {{ $post->favorite_to_users->count() }}
                                        </a>

                                        <form action="{{ route('post.favorite',$post->id) }}" id="favorite-form-{{$post->id}}" method="POST" style="display: none" >
                                            @csrf
                                        </form>
                                    @endguest

                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                            </ul>
                        </div>


                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                            <p> {{ $post->user->about }} </p>
                        </div>

                        <div class="tag-area">

                            <h4 class="title"><b>CATEGORIES</b></h4>
                            <ul>
                                @foreach($post->categories as $category)
                                <li><a href="#"> {{ $category->name }} </a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">

                @foreach($randomposts as $randompost)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{ asset('storage/post/'.$randompost->image) }}" alt="{{ $randompost->tittle }}"></div>

                                <a class="avatar" href=""><img src="{{ asset('storage/profile/'.$randompost->user->image) }}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{ route('post.details',$randompost->slug) }}"><b>{{ $randompost->tittle }}</b></a></h4>

                                    <ul class="post-footer">
                                        <li>
                                            @guest
                                                <a href="javascript:void(0);" onclick="toastr.info('To add favorite list,You need to login first','Info',{
                                                    closeButton:true,
                                                    progressBar:true,
                                                })" ><i class="ion-heart"></i>
                                                    {{ $randompost->favorite_to_users->count() }}
                                                </a>
                                            @else
                                                <a class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$randompost->id)->count() == 0 ? 'favorite_posts' : ' ' }}" href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{$post->id}}').submit();" ><i class="ion-heart"></i>
                                                    {{ $randompost->favorite_to_users->count() }}
                                                </a>

                                                <form action="{{ route('post.favorite',$randompost->id) }}" id="favorite-form-{{$randompost->id}}" method="POST" style="display: none" >
                                                    @csrf
                                                </form>
                                            @endguest

                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{ $randompost->view_count }}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endforeach
            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        @guest
                            <p>To comment,Please Login first <a href="{{ route('login') }}">LOG-IN</a> </p>
                        @else
                            <form action="{{ route('comment.store',$post->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                    </div><!-- col-sm-12 -->
                                    <div class="col-sm-12">
                                        <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                    </div><!-- col-sm-12 -->

                                </div><!-- row -->
                            </form>
                        @endguest
                    </div><!-- comment-form -->

                    <h4><b>COMMENTS({{ $post->comments()->count() }})</b></h4>

                    @if($post->comments->count() >0 )
                        @foreach($post->comments as $comment)
                            <div class="commnets-area ">

                                <div class="comment">

                                    <div class="post-info">

                                        <div class="left-area">
                                            <a class="avatar" href="#"><img src="{{ asset('storage/profile/'.$comment->user->image) }}" alt="Profile Image"></a>
                                        </div>

                                        <div class="middle-area">
                                            <a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
                                            <h6 class="date">on {{ $comment->created_at->diffForHumans() }}</h6>
                                        </div>

                                        <div class="right-area">
                                            <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                        </div>

                                    </div><!-- post-info -->

                                    <p>{{ $comment->comment }}</p>

                                </div>

                            </div><!-- commnets-area -->
                        @endforeach
                    @else
                        <a class="more-comment-btn" href="#"><b>No comments is here</a>
                    @endif



                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>

@endsection

@push('js')

@endpush
