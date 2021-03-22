<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $title = "Dashboard";
        return view("admin.dashboard")->with(["title" => $title]);
    }

}
