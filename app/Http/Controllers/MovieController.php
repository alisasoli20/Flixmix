<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){
        $title = "Movie";
        return view("front.movie")->with(["title" => $title]);
    }
    public function movies(){
        $title = "Movies";
        $movies = Movie::all();
        return view("admin.movies.index")->with(["title" => $title, "movies" => $movies]);
    }
    public function addMovie(){
        $title = "Add Movie";
        return view("admin.movies.add")->with(["title" => $title]);
    }
    public function storeMovie(Request $request){
        $data = $request->except("_token");
        $poster = $request->file("poster");
        $filename = time().".".$poster->getClientOriginalExtension();
        $poster->move(public_path("images"),$filename);
        $data["poster"] = $filename;
        $data["user_id"] = Auth()->id();
        $data["created_at"] = Carbon::now();
        Movie::insert($data);
        session()->flash("success","Movie has been added successfully");
        return redirect(route("admin.movies"));
    }
    public function edit($id){
        $title = "Edit Movie";
        $movie = Movie::where('id',$id)->first();
        return view("admin.movies.edit")->with(["title" => $title, 'movie' => $movie]);
    }
    public function delete($id){
        $movie = Movie::where('id',$id)->first();
        @unlink(public_path("images/".$movie->poster));
        Movie::where('id',$id)->delete();
        session()->flash("success","Movie has been deleted");
        return redirect(route("admin.movies"));
    }
    public function update(Request $request,$id){
        $data = $request->except("_token");
        if($request->hasFile("poster")){
            $filename = time().".".$poster->getClientOriginalExtension();
            $poster->move(public_path("images"),$filename);
            $data["poster"] = $filename;
        }
        $data["user_id"] = Auth()->id();
        $data["created_at"] = Carbon::now();
        Movie::where('id',$id)->update($data);
        session()->flash("success","Movie has been updated successfully");
        return redirect(route("admin.movies"));
    }
}
