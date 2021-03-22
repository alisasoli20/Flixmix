@extends('layout.app')
@section('section')
    <section>
        <div class="container">
            <div class="row ">
                <div class="col-12 login-box ">
                    <center>
                        {{--<img class="logo-image mb-3" src="./images/logo.jpg"  width="50px" height="50px">--}}
                        <h1>Flixmix</h1>
                    </center>
                    <form method="POST" action="javascript:void(0)" onsubmit="return Login()">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" id="username" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button id="login" class="mt-2 btn btn-primary custom-button">Login</button>
                    </form>
                    <div id="error" hidden class="alert alert-danger"></div>
                    <div class="mt-4 text-center">
                        <p>Don't have an account?Click <a href="{{ route("register") }}">here</a></p>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
@section('page-css')
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('page-script')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function Login(){
            $('#login').html("Loading...")
            $("#login").prop("disabled","disabled")
            var data = $('form').serialize()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url : '{{ route("login") }}',
                type: "POST",
                data:  data ,
                success: function(response){
                    $("#login").html("Login")
                    $("#login").prop("disabled","")
                    if(response == 1){
                        window.location.replace('{{ route("profile") }}')
                    }
                    else if(response == 2){
                        $("#error").prop("hidden","").html("Invalid Username or Password").fadeIn("slow");
                    }
                }
            })
        }
    </script>
@endsection
