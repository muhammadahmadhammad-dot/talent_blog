<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->route('blog')->user_id == auth()->id();  // user_id == auth()->id
    }

    public function prepareForValidation(){
        $this->merge([
            'slug' => Str::slug($this->slug)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category'=>'required|exists:categories,id',
            'title'=>'required|string|max:255',
            'slug'=>'required|unique:blogs,slug,'.$this->route('blog')->id,
            'image'=>'nullable|image|mimes:png,jpg,jpeg,webp',
            'image_caption'=>'nullable|string|max:255',
            'short_description'=>'required|string|max:255',
            'description'=>'required|string',
            'date'=>'required|date',
        ];
    }
}
