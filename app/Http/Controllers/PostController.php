<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;


class PostController extends Controller implements HasMiddleware
{
public static function middleware(): array
{
    return [
        new Middleware('auth', except: ['show', 'index']),
        ];
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $posts =  Post::latest()->paginate(3);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        if(request()->hasFile('photo')) {
            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos', $name);

        }
            $post = Post::create([
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'tag_id' => $request->tag_id,
                'title' => $request->title,
                'short_content' => $request->short_content,
                'content' => $request->full_content,
                'photo' => $path ?? '',
            ]);

        if (isset($request->tags)) {
            foreach ($request->tags as $tag) {
                $post->tags()->attach($tag);
            }

    }

        PostCreated::dispatch($post);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
        'recent_posts' => Post::latest()->take(3)->get()->except($post->id),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.edit')->with(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post): RedirectResponse
    {

        Gate::authorize('update', $post);


        if(request()->hasFile('photo')) {
            if (isset($post->photo)) {
                Storage::delete($post->photo);
            }

            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos', $name);
        }
            $post->update([
                'title' => $request->title,
                'short_content' => $request->short_content,
                'content' => $request->full_content,
                'photo' => $path ?? $post->photo,
            ]);

        return redirect()->route('posts.show', ['post' => $post->id]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post):RedirectResponse
    {
        Gate::authorize('delete', $post);

        if(isset($post->photo)) {
              Storage::delete($post->photo);
          }

          $post->tags()->detach();
          $post->tags()->delete();
          $post->comments()->delete();
          $post->delete();
          return redirect()->route('posts.index');
    }
}


