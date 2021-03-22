@extends('layout.app')
@section('section')
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
                                            <li class="breadcrumb-item active" aria-current="page">{{ $movie->title }}</li>
                                        </ol>
                                    </nav>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 offset-md-1 movie-overview">
                                <div class="row">
                                    <div class="col-md-3 poster-container">
                                        <img class="poster image-responsive" src="https://m.media-amazon.com/images/M/MV5BNGZlNjdlZmMtYTg0MC00MmZkLWIyNDktYmNlOWYzMTkzYWQ1XkEyXkFqcGdeQXVyNDk3NzU2MTQ@._V1_UX182_CR0,0,182,268_AL_.jpg">
                                    </div>
                                    <div class="col-md-9 movie-data">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <h1 id="movie-title">{{ $movie->title }}</h1>
                                                <span class="genre">{{ $movie->genre }}</span>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p><strong>Description: </strong>{!!   $movie->description !!}</p>
                                                <p><strong>Cast: </strong>{!! $movie->cast !!}}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-sm-3">
                                <a class="btn btn-warning" href="{{ route("post.new",$movie->id) }}"><i class="fa fa-plus-circle"></i> Add New Post</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Thread Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Replies</th>
                                        <th scope="col">Latest</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td><a href="{{ route('post',[$movie->id, $post->id]) }}">{!! $post->title !!}</a></td>
                                            <td>{!! $post->user->email !!}</td>
                                            <td>{!! $post->replies->count() !!}</td>
                                            <td>{!! $post->updated_at->diffForHumans() !!}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>
    @include("layout.footer")
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('page-script')
@endsection
