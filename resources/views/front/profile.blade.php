@extends('layout.app')
@section('section')
    <section class="container">
        @include("layout.navbar")
        <div class="container pb-5" style="background-color: #FFF">
            <div class="row">
                <div class="col-md-3 mt-5 text-center">
                    <div class="card">
                         <div class="card-body">
                             <img id="profile-photo" class="profile-image mr-2" src="{{  (auth()->user()->profile_picture == "")?asset("images/man-avatar.jpg"):asset("images/".auth()->user()->profile_picture) }}" >
                             <div class="custom-file mt-2  mb-3">
                                 <input type="file" class="custom-file-input" name="file" id="file">
                             </div>
                         </div>
                    </div>
                </div>
                <div class="col-md-9 mt-4">
                    <div class="form-group side-button">
                        <label>Description</label>
                        <a  data-bs-toggle="modal" data-bs-target="#descriptionModal">
                            <i class="fa fa-edit"></i>
                        </a>
                        <textarea  class="form-control" rows="5" readonly>{{ auth()->user()->description }}</textarea>
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
            <div class="row mt-4 ">
                <div class="col-md-11 offset-md-1">
                    <h3>Replies</h3>
                    <hr>
                    @foreach($replies as $reply)
                        <a style="color: #337ab7; text-decoration: none; letter-spacing: 0px" href="{{ route('post',[$reply->movie_id,$reply->post_id]) }}">{{ $reply->reply }}</a>
                        <p class="mb-3" style="font-size: .9em;color: gray;">posted {{ $reply->created_at->diffForHumans() }} in {{ $reply->movie->title }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Edit Description Modal -->
        <div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route("edit.description") }}">
                    @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Description</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <textarea name="description" rows="5" class="form-control" required>{{ auth()->user()->description }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

@endsection
@section('page-css')
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .side-button{
            position: relative;
        }
        .side-button a{
            position: absolute;
            right: 0;
            top: 0;
        }
    </style>

@endsection
@section('page-script')
    <script>
        $(document).ready(function(){
            $(document).on('change', '#file', function(){
                var name = document.getElementById("file").files[0].name;
                console.log(document.getElementById("file").files[0])
                var form_data = new FormData();
                var ext = name.split('.').pop().toLowerCase();
                if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                {
                    alert("Invalid Image File");
                }
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("file").files[0]);
                var f = document.getElementById("file").files[0];
                var fsize = f.size||f.fileSize;
                if(fsize > 200000000)
                {
                    alert("Image File Size is very big");
                }
                else
                {
                    form_data.append("file", document.getElementById('file').files[0]);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:"{{ route('user.newPhoto') }}",
                        type:"POST",
                        data: form_data,
                        dataType: "JSON",
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend:function(){
                            //   $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                        },
                        success:function(data)
                        {
                            if(data.response != 0) {
                                $('#profile-photo').attr("src",'{{ asset("images/") }}'+data.profile_picture);
                                window.location.href = '{{ route("profile") }}'

                            }else{
                                alert("image uploading error");
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
