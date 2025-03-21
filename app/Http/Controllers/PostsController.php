<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostImage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.listing')
            ->with('posts', Post::orderBy('updated_at', 'DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string', // Changed back to 'content' to match form
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);


        // Generate description from content (first 150 characters)
        $description = substr(strip_tags($request->input('content')), 0, 150);
        if (strlen(strip_tags($request->input('content'))) > 150) {
            $description .= '...';
        }

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        // Create post with both content and auto-generated description
        $post = Post::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'description' => $description, // Auto-generated description
                'slug' => $slug,
                'user_id' => auth()->user()->id,
            ]);

        //stores images
        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('images', $filename, 'public');

                PostImage::create([
                    'post_id' => $post->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('posts.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    // Show a single blog post
        public function show($slug)
        {
            // Find the post by its slug
            $post = Post::where('slug', $slug)->firstOrFail();

            // Pass the post to the view
            return view('blog.show', compact('post'));
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('blog.edit')
            ->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required', // Changed from 'description'
        ]);

        // Generate description from content
        $description = substr(strip_tags($request->input('content')), 0, 150);
        if (strlen(strip_tags($request->input('content'))) > 150) {
            $description .= '...';
        }

        Post::where('slug', $slug)
             ->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'description' => $description, // Auto-generated description
                'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
                'user_id' => auth()->user()->id
                ]);

        return redirect('/blog')
            ->with('message', 'Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug);
        $post->delete();

        return redirect('/blog')
            ->with('message', 'Your post has been deleted!');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $posts = Post::where('title', 'LIKE', "%{$query}%")
                    ->with('user')
                    ->paginate(10);

        return view('blog.listing', compact('posts'));
    }

}

