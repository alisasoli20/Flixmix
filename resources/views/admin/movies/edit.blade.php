@extends("admin.layout.app")
@section("section")
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Movies</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Movie</h3>

                </div>
                <div class="card-body ">
                    <form method="POST" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="movie-title">Movie Title</label>
                            <input type="text" class="form-control" id="movie-title" name="title" placeholder="Enter Movie Title" value="{{ $movie->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="movie-genre">Movie Genre</label>
                            <input type="text" class="form-control" id="movie-genre" name="genre" placeholder="Enter Movie Genre" value="{{ $movie->genre }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control movie-description" required rows="4" id="description" name="description" placeholder="Enter Movie Description...">{!! $movie->description !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="cast">Cast</label>
                            <input type="text" class="form-control" id="cast" name="cast" placeholder="Enter Movie Cast" value="{{ $movie->cast }}" required>
                        </div>

                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <input type="text" class="form-control" id="rating" name="rating" placeholder="Enter Movie Rating" value="{{ $movie->rating }}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Movie Poster</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="poster" >
                                    <label class="custom-file-label" for="exampleInputFile">Choose Image</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-success"><i class="fa fa-save"></i>  Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section("page-css")

@endsection
@section("page-script")
    <!-- Summernote -->

    <script>
        $("#movies").addClass("active");
    </script>
    <script>
        $(document).ready(function(){
            $(function () {
                // Summernote
                $('.movie-description').summernote()

            })
        })

    </script>
@endsection
