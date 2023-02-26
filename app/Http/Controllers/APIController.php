<?php

namespace App\Http\Controllers;

use ajax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    //
    public function posts()
    {
       // $posts = Http::get('https://jsonplaceholder.typicode.com/posts')->json();

        // $response = Http::withToken('fdddddd')->post('https://jsonplaceholder.typicode.com/posts', [
        //     'name' => 'Steve',
        //     'role' => 'Network Administrator',
        // ]);

        //  return view('site.posts-api' , compact('posts'));
        return view('site.posts-api');
        //dd($posts);


    }
}
