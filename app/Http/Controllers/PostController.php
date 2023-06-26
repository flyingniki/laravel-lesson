<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::find(1);
        $posts = Post::all();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string'
        ]);
        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string'
        ]);
        $post->update($data);
        return redirect()->route('post.show', $post->id);
    }

    public function delete()
    {
        $post = Post::find(4);
        $post->delete();
        dd('deleted');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    public function restore()
    {
        $post = Post::withTrashed()->find(4);
        $post->restore();
        dd('restored');
    }

    public function firstOrCreate()
    {
        $anothetPost = [
            'title' => 'another of posts',
            'content' => 'another some content',
            'image' => 'another_image.jpg',
            'likes' => '50',
            'is_published' => '1',
        ];

        $post = Post::firstOrCreate([
            'title' => 'title of php',
        ], $anothetPost);

        dump($post->content);
        dd('firstOrCreate');
    }

    public function updateOrCreate()
    {
        $anothetPost = [
            'title' => 'third type of posts',
            'content' => 'third of some content',
            'image' => 'another_image.jpg',
            'likes' => '50',
            'is_published' => '1',
        ];

        $post = Post::updateOrCreate([
            'title' => 'title of posts',
        ], $anothetPost);

        dump($post->content);
        dd('firstOrCreate');
    }
}
