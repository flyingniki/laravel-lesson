<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        // $tag = Tag::find(1);
        // $category = Category::all(1);
        // $posts = Post::where('category_id', $category->id)->get();
        // dd($tag->posts);
        // $tag = Tag::find(1);
        // dd($post->tags);

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => ''
        ]);
        $tags = $data['tags'];
        unset($data['tags']);
        // dd($tags, $data);
        $post = Post::create($data);
        // foreach ($tags as $tag) {
        //     PostTag::firstOrCreate([
        //         'tag_id' => $tag,
        //         'post_id' => $post->id
        //     ]);
        // }
        $post->tags()->attach($tags);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => ''
        ]);
        $tags = $data['tags'];
        unset($data['tags']);
        $post->update($data);
        $post = $post->fresh();
        $post->tags()->sync($tags);
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
