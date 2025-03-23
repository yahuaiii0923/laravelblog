<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Contact;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
        {
            $posts = Post::latest()->take(3)->get();
            return view('main', compact('posts'));
        }

  public function contact()
      {
          return view('contact');
      }

  public function submitContact(Request $request)
      {
          // Validate the form data
          $validated = $request->validate([
              'name' => 'required|max:255',
              'email' => 'required|email',
              'message' => 'required|min:10'
          ]);

          // Save to database only
          Contact::create($validated);

          // Redirect back with success message
          return redirect()->back()->with('success', 'Thank you for your message! We will respond within 3 business days.');
  }

      /**
       * Display Safety & Care page
       */
      public function care()
      {
          return view('care');
      }

      /**
      * Display How We Measure page
      */
      public function measure()
      {
          return view('measure');
      }

  }
