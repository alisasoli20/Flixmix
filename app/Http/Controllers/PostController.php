<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($movie_id,$post_id)
    {
        $post = Post::where('id',$post_id)->first();
        $movie = Movie::where('id',$movie_id)->first();
        $replies = Reply::where('movie_id',$movie_id)->get();
        $title = $post->title;
        return view("front.post.index")->with(["title" => $title,"post"=> $post, "movie" => $movie, 'replies' => $replies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $movie = Movie::where('id',$id)->first();
        $title = "Add New Post";
        return view('front.post.new')->with(["title" => $title, "movie" => $movie]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $data = $request->except("_token");
        $data["user_id"] = Auth()->id();
        $data["movie_id"] = $id;
        $movie = Movie::where('id',$id)->first();
        Post::create($data);
        return redirect(route("movie",$movie->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function addReply(Request $request,$movie_id, $post_id){
        $data = $request->except("_token");
        $data['movie_id'] = $movie_id;
        $data['post_id'] = $post_id;
        $data['user_id'] = Auth::user()->id;
        Reply::create($data);
        return redirect()->back();
    }
}
