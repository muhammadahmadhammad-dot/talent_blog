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
        return view('dashboard.blog.index', compact('blogs'));
    }


    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('dashboard.blog.create', compact('categories'));
    }


    public function store(StoreBlogRequest $request)
    {
        $request->validated();

        // generate slug and merge in request 
        $request->merge(['slug' => Str::slug($request->title)]);
        // validate slug it must be unique
        $validated = Validator::make($request->all(), [
            'slug' => 'unique:blogs,slug',
        ]);
        // if its not unique than we add some counting
        if ($validated->fails()) {
            $request->merge(['slug' => Str::slug($request->title) . '-' . strtotime(now())]);
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
                'user_id' => auth()->id(), 
                'short_description' => $request->short_description,
                'description' => $request->description,
                'date' => $request->date,
                'image' => $imageName,
                'image_caption' => $request->image_caption,
            ]);
            return to_route('blog.index')->with('success', 'Blog created successfully.');
        } catch (\Exception $exp) {
            return to_route('blog.create')->withInput()->with('error', 'Something Thing Wrong. Error : ' . $exp);
        }
    }

    public function show(Blog $blog)
    {
        return view('dashboard.blog.show', compact('blog'));
    }


    public function edit(Blog $blog)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('dashboard.blog.edit', compact('categories', 'blog'));
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $validated = $request->validated();
        try {
            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imageName = 'blog/' . strtotime('now') . '.' . $ext;  //12121.jpg

                // move to folder
                Storage::disk('public')->put($imageName, file_get_contents($image));

                $validated['iamge'] = $imageName;


                // delete old image
                if ($blog->image) {
                    Storage::disk('public')->delete($blog->image);
                }
            }

            $validated['category_id'] = $validated['category'];
            $blog->update($validated);
            return to_route('blog.index')->with('success', 'Blog updated successfully.');
        } catch (\Exception $exp) {
            return to_route('blog.create')->withInput()->with('error', 'Something Thing Wrong. Error : ' . $exp);
        }
    }

    public function destroy(Blog $blog)
    {
        
        $title = $blog->title;
        $id = $blog->id;
        try {
            $blog->delete();
            return to_route('blog.index')->with('success', "Blog \" {$title} \" deleted successfully.");
        } catch (\Exception $exp) {
            return to_route('blog.show',$id)->with('error', 'Something Thing Wrong. Error : ' . $exp);
        }
    }
}
