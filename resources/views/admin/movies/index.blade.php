@extends("admin.layout.app")
@section("section")
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Movies</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('admin.movie.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Movie</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @if(session()->has("success"))
            <div class="alert alert-success">
                {{ session()->get("success") }}
            </div>
        @elseif(session()->has("error"))
            <div class="alert alert-danger">
                {{ session()->get("error") }}
            </div>
        @endif
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Movies</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 20%">
                                Movie Title
                            </th>
                            <th style="width: 20%">
                                Genre
                            </th>
                            <th style="width: 20%">
                                Submitted By
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($movies as $movie)
                                <tr>
                                    <td>{{ $movie->id }}</td>
                                    <td>{{ $movie->title }}</td>
                                    <td>{{ $movie->genre }}</td>
                                    <td>{{ $movie->user->name}}</td>
                                    <td class="project-actions text-right">

                                        <form method="POST" action="{{ route('admin.movie.delete',$movie->id) }}">
                                            <a class="btn btn-info btn-sm" href="{{ route('admin.movie.edit',$movie->id) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            @csrf
                                        <button class="btn btn-danger btn-sm" >
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <script>
        $("#movies").addClass("active");
    </script>
@endsection
