<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // return 'this is my page';
        // $str = 'string';
        // dd($str);
        $post = Post::find(1);
        // dump($post);
        $posts = Post::all();
        // dump($posts);

        $posts = Post::where('is_published', 1)->get();
        foreach ($posts as $post) {
            dump($post->title);
        }
    }

    public function create()
    {
        $postsArr = [
            [
                'title' => 'title of posts',
                'content' => 'some content',
                'image' => 'image.jpg',
                'likes' => '20',
                'is_published' => '1',
            ],
            [
                'title' => 'another of posts',
                'content' => 'another some content',
                'image' => 'another_image.jpg',
                'likes' => '50',
                'is_published' => '1',
            ],
        ];

        // Post::create([
        //     'title' => 'title of posts',
        //     'content' => 'some content',
        //     'image' => 'image.jpg',
        //     'likes' => '20',
        //     'is_published' => '1',
        // ]);
        // dd('created');

        foreach ($postsArr as $item) {
            Post::create($item);
            dd('created');
        }
    }

    public function update()
    {
        $post = Post::find(5);

        $post->update([
            'title' => 'updated',
            'image' => 'updated'
        ]);

        dd('updated');
    }

    public function delete()
    {
        $post = Post::find(4);
        $post->delete();
        dd('deleted');
    }

    public function restore()
    {
        $post = Post::withTrashed()->find(4);
        $post->restore();
        dd('restored');
    }
}
