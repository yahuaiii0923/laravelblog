<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('index');
    }

   public function listing()
   {
       $posts = Post::latest()->get(); // Fetch all posts from the database
       return view('listings', ['posts' => $posts]); // Pass the $posts variable to the view
   }
}
