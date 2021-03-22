@extends('layout.app')
@section("section")
    <section class="container">
        @include("layout.navbar")
        <div class="container pb-5" style="background-color: #FFF">
            <div class="row">
                <div class="col-md-3 mt-5 text-center">
                    <img id="profile-photo" class="profile-image mr-2" src="{{  ($user->profile_picture == "")?asset("images/man-avatar.jpg"):asset("images/".$user->profile_picture) }}" >
                </div>
                <div class="col-md-9 mt-4">
                    <div class="form-group side-button">
                        <label>Description</label>
                        <textarea  class="form-control" rows="5" readonly>{{ $user->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row mt-4 ">
                <div class="col-md-11 offset-md-1">
                    <h3>Posts</h3>
                    <hr>
                    @foreach($posts as $post)
                        <a style="color: #337ab7; text-decoration: none; letter-spacing: 0px" href="{{ route('post',[$post->movie->id,$post->id]) }}">{{ $post->title }}</a>
                        <p class="mb-3" style="font-size: .9em;color: gray;">posted {{ $post->created_at->diffForHumans() }} in {{ $post->movie->title }}</p>
                    @endforeach
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
@endsection
