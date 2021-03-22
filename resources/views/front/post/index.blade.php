@extends('layout.app')
@section("section")
    <section class="container">
        @include('layout.navbar')
        <div class="container" style="background-color: #FFF;">
            <div class="main ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-10 offset-md-1 no-padding ml-5">
                                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route("movie",$movie->id) }}">{{ $movie->title }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 offset-md-1 movie-overview">
                                <div class="row">
                                    <div class="col-md-12 poster-container" style="padding: 0px!important;">
                                        <h1 style="font-size: 18px!important;letter-spacing: 0px!important;">{!! $post->title !!}</h1>
                                        <span class="genre">posted  {!! $post->created_at->diffForHumans() !!} by {!! $post->user->name !!}</span>
                                        <p class="mt-3">{!! $post->description !!}</p>
                                        <a class="reply-btn" href="javascript:void(0)" id="reply-btn">
                                            <i class="far fa-comment" aria-hidden="true">

                                            </i>
                                            reply
                                        </a>
                                        <div id="reply-container" style="display: none">
                                            <form class="mt-2 pb-3" method="POST" action="#">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea class="form-control" name="reply" rows="6" placeholder="Type Your reply here..." required></textarea>
                                                </div>
                                                <div class="d-grid mt-2">
                                                     <button class="btn btn-warning">Add Reply</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <hr style="margin-top: 30px; margin-bottom: 20px">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 offset-md-1 movie-overview">
                                <div class="row">
                                    <div class="col-md-12 poster-container" style="padding: 0px!important;">
                                        @foreach($replies as $reply)
                                            <a style="text-decoration: none; color: #337ab7;" href="{{ route("profile.show",$reply->user_id) }}">{{ $reply->user->name }}<span style="color: gray;">   {{ $reply->created_at->diffForHumans() }}</span></a>
                                            <p class="mb-4">{{ $reply->reply }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </section>
    @include("layout.footer")
@endsection
@section("page-css")
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section("page-script")
    <script>
        $(document).ready(function(){
            $('#reply-btn').on("click",function(){
                if($(this).text() != "cancel") {
                    $(this).html("cancel")
                    $("#reply-container").css("display", "block").fadeIn(2000);
                }else{
                    $(this).html("<i class='far fa-comment'> </i>reply")
                    $("#reply-container").css("display","none");
                }
            })
        })
    </script>
@endsection
