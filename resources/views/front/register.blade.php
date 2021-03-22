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
                    <form method="POST" action="javascript:void(0)" onsubmit="return Register()">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" id="email" class="form-control" aria-describedby="emailHelp" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control"  name="password" required>
                        </div>
                        <button id="register" type="submit" class="mt-2 btn btn-primary custom-button">Register</button>
                    </form>
                    <div id="error" hidden class="alert alert-danger"></div>
                    <div class="mt-4 text-center">
                        <p>Already have an account?Click <a href="{{ route("/") }}">here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
@endsection
@section('page-script')
    <script>
        $(document).ready(function(){
            $("#error").prop("hidden","hidden").html("").fadeIn("slow");
        })
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function Register(){
            if($("#password").val().length < 8){
                $("#error").prop("hidden","").html("Password length must be greater than 8").fadeIn("slow");
                return false;
            }
            if(checkAlreadyExists()){
                alert("called");
                $("#error").prop("hidden","").html("User already exists").fadeIn("slow");
                return false;
            }
            $('#register').html("Loading...")
            $("#register").prop("disabled","disabled")
            var data = $('form').serialize()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url : '{{ route("register.post") }}',
                type: "POST",
                data:  data ,
                success: function(response){
                    $("#register").html("Register")
                    $("#register").prop("disabled","")
                    if(response == 1){
                        window.location.replace('{{ route("/") }}')
                    }
                    else if(response == 2){
                        $("#error").prop("hidden","").html("Invalid Username or Password").fadeIn("slow");
                    }
                },
                error: function (response){
                    $('#register').html("Register")
                    $("#register").prop("disabled","")
                    return false;
                }
            })
        }
        function checkAlreadyExists(){
            var username = $("#email").val();
            var error = false
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url : '{{ route("user.check") }}',
                type: "POST",
                data: {username: username},
                success : function (response){
                   if(response == 1 ){
                       error = true
                       return true
                   }
                   else{
                       error = false
                   }
                },
                error: function(data){
                   error = false
                }
            });
            return Boolean(error)
        }
    </script>
@endsection

