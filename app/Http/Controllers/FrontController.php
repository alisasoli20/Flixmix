<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect("profile");
        }
        $title = "Login";
        return view('front.login',compact('title'));
    }
    public function register(){
        $title = "Register";
        return view("front.register",compact('title'));
    }
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        if(auth()->attempt(["email"=> $username, "password" => $password])){
            return response()->json([1]);
        }
        else{
            return response()->json([2]);
        }
    }
    public function profile(){
        $title = "Profile";
        $posts = Post::where('user_id',Auth::user()->id)->get();
        $replies = Reply::where('user_id',Auth::user()->id)->get();
        if(Auth::user()->role == 1){
            return redirect(route("admin"));
        }
        return view("front.profile")->with(["title" =>  $title, "posts" => $posts, "replies" => $replies]);
    }
    public function home(){
        $title = "Home";
        $movies = Movie::all();
        return view("front.home")->with(["title"  => $title, "movies" => $movies]);
    }
    public function newPhoto(Request $request){
        if($request->hasFile("file")) {
            $image = $request->file("file");
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path("images"),$filename);
            $user = User::where('id',Auth()->user()->id)->first();
            $user->profile_picture = $filename;
            $user->save();
            $data["response"] = 1;
            $data["profile_picture"] = $filename;
            return json_encode($data);
        }else{
            return response()->json([0]);
        }
    }
    public function postRegister(Request $request){
        $data = $request->except("_token");
        $data["password"] = bcrypt($data["password"]);
        User::create($data);
        return response()->json([1]);
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect(route("/"));
    }
    public function checkUser(Request $request){
        $username = $request->username;
        $user = User::query()->where('email',$username)->first();
        if($user){
            return response()->json([1]);
        }
        else{
            return response()->json([0]);
        }
    }
    public function editDescription(Request $request){
        $description = $request->description;
        $user = Auth::user();
        $user->description = $description;
        if($user->save()){
            return redirect(route("profile"));
        }
    }
    public function movie($id){
        $movie = Movie::where('id',$id)->first();
        $title = $movie->title;
        $posts = $movie->posts;
        return view('front.movie')->with(["title"=> $title, "movie" => $movie, "posts" => $posts]);
    }
    public function showProfile($id){
        $user = User::where('id',$id)->first();
        $posts = Post::where('user_id',$user->id)->get();
        $title = $user->name;
        return view("front.user_profile")->with(["title" => $title, "user" => $user, "posts" => $posts]);
    }
}
