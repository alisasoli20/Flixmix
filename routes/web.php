<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',["App\\Http\\Controllers\\FrontController","index"])->name('/');
Route::post("/",["App\\Http\\Controllers\\FrontController","login"])->name("login");
Route::get("/register",["App\\Http\\Controllers\\FrontController","register"])->name('register');
Route::post("/register",["App\\Http\\Controllers\\FrontController","postRegister"])->name('register.post');
Route::post("/check/user",["App\\Http\\Controllers\\FrontController","checkUser"])->name("user.check");
Route::group(["middleware" => ["auth"]],function (){
    Route::get("/home",["App\\Http\\Controllers\\FrontController","home"])->name("home");
    Route::post('/profile/picture',["App\\Http\\Controllers\\FrontController","newPhoto"])->name("user.newPhoto");
    Route::get('/profile',["App\\Http\\Controllers\\FrontController","profile"])->name("profile");
    Route::get("/profile/{id}",["App\\Http\\Controllers\\FrontController","showProfile"])->name("profile.show");
    Route::post("/edit/description",["App\\Http\\Controllers\\FrontController","editDescription"])->name("edit.description");
    Route::get("/movie/{id}",["App\\Http\\Controllers\\FrontController","movie"])->name("movie");
    Route::get("/movie/{id}/new",["App\\Http\\Controllers\\PostController","create"])->name("post.new");
    Route::post('/movie/{id}/new',['App\Http\Controllers\PostController',"store"])->name("post.add");
    Route::get("/movie/{movie_id}/post/{post_id}",["App\\Http\\Controllers\\PostController","index"])->name("post");
    Route::post('/movie/{movie_id}/post/{post_id}',["App\\Http\\Controllers\\PostController","addReply"]);
    Route::post("/logout",["App\\Http\\Controllers\\FrontController","logout"])->name("logout");
});
Route::group(["middleware"=> ["auth","admin"]],function(){
    Route::group(['prefix' => "admin"],function(){
        Route::get("/",["App\\Http\\Controllers\\AdminController","index"])->name("admin");
        Route::get("/movies",["App\\Http\\Controllers\\MovieController","movies"])->name("admin.movies");
        Route::get("/movie/add",["App\\Http\\Controllers\\MovieController","addMovie"])->name("admin.movie.add");
        Route::post("/movie/add",["App\\Http\\Controllers\\MovieController","storeMovie"]);
        Route::get("/movie/edit/{id}",["App\\Http\\Controllers\\MovieController","edit"])->name("admin.movie.edit");
        Route::post("/movie/edit/{id}",["App\\Http\\Controllers\\MovieController","update"]);
        Route::post("/movie/delete/{id}",["App\\Http\\Controllers\\MovieController","delete"])->name("admin.movie.delete");
    });
});
