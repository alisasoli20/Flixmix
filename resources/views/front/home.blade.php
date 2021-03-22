@extends("layout.app")
@section('section')
    <section class="container">
        @include('layout.navbar')
        <div class="container pb-5" style="background-color: #FFF; height: 100vh">
            <div class="row">
                <div class="col-md-12 mt-4 text-center">
                    <h1>Flixmix - Discuss Movies </h1>
                    <p>The Best Movie Forum & Message Board with Reviews, Ratings, Cast, Quotes & News. </p>
                </div>
            </div>
            <div class="row mt-5 justify-content-center">
                <div class="col-md-9">
                    <div class="card">
                         <div class="card-body">
                             <h3 style="color: #ff0000"><i class="fas fa-chart-line"></i> Trending</h3>
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="splide">
                                         <div class="splide__track">
                                             <div class="splide__list">
                                                 @foreach($movies as $movie)
                                                 <div class="splide__slide ">
                                                     <a href="{{ route("movie",$movie->id ) }}"><img class="movie-image" width="102px" height="150px" src="{{ asset("images/".$movie->poster) }}"></a>
                                                     <span class="trending-text movie-text">{{ $movie->title }}</span>
                                                     <span class="trending-text">{{ $movie->created_at->diffForHumans() }}</span>
                                                 </div>
                                                 @endforeach
                                             </div>
                                         </div>
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
@section('page-css')
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset("vendor/splide/dist/css/splide.min.css") }}">
@endsection
@section('page-script')
    <script src="{{ asset("vendor/splide/dist/js/splide.js") }}"></script>
    <script>
        new Splide( '.splide', {
            perPage: 6,
            perMove: 1,
        } ).mount();
    </script>

@endsection
