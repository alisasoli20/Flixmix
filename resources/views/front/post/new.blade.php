@extends('layout.app')
@section("section")
    <section class="container">
        @include('layout.navbar')
        <div class="container" style="background-color: #FFF">
            <main class="main" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item" aria-current="page">{{ $movie->title }}/li>
                                        <li class="breadcrumb-item active" aria-current="page">New Post</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <h1>{{ $movie->title }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <form method="POST" action="{{ route('post.add',$movie->id) }}">
                                    @csrf
                                    <div class="form-group">
                                        <input name="title" class="form-control" placeholder="Post Title" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <textarea name="description" class="form-control" placeholder="Type your post here..." rows="10" required></textarea>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-warning btn-block mt-2 " style="display: block">Submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
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
