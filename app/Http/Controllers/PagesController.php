<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
        {
            $posts = Post::latest()->take(3)->get();
            return view('main', compact('posts'));
        }

   public function listing()
   {
       $posts = Post::latest()->get(); // Fetch all posts from the database
       return view('listings', ['posts' => $posts]); // Pass the $posts variable to the view
   }
}
