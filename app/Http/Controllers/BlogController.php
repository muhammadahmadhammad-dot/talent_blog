<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\Blog\StoreBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('dashboard.blog.index',compact('blogs'));
    }

 
    public function create()
    {
        $categories = Category::orderBy('name','asc')->get();
        return view('dashboard.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $request->validated();

        // generate slug and merge in request 
        $request->merge(['slug' => Str::slug($request->name)]);
        // validate slug it must be unique
        $validated = Validator::make($request->all(), [
            'slug' => 'unique:blogs,slug',
        ]);
        // if its not unique than we add some counting
        if ($validated->fails()) {
            $request->merge(['slug' => Str::slug($request->name) . '-' . strtotime(now())]);
        }

        try {

            $imageName = Null;
            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imageName = 'blog/' . strtotime('now') . '.' . $ext;  //12121.jpg

                // move to folder
                Storage::disk('public')->put($imageName, file_get_contents($image));
            }

            Blog::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'category_id' => $request->category,
                'user_id' => 1, // fixing after login -------------------------------ERROR
                'short_description' => $request->short_description,
                'description' => $request->description,
                'date' => $request->date,
                'image' => $imageName,
                'image_caption' => $request->image_caption,
            ]);
            return to_route('blog.index')->with('success', 'Blog created successfully.');
        } catch (\Exception $exp) {
            return to_route('blog.index')->with('error', 'Something Thing Wrong. Error : ' . $exp);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
