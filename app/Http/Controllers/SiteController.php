<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(){
        $blogs = Blog::select('slug','user_id','title','created_at','short_description')->latest()->paginate(25);
        return view('welcome',compact('blogs'));
    }
    public function blogDetail(string $slug){
        $blog = Blog::where('slug',$slug)->first();
        if(!$blog){
            return $slug;
        }
        return view('blog-detail',compact('blog'));
    }
}
