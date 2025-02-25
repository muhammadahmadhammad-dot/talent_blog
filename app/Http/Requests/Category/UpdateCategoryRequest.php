<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use illuminate\Support\Str;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'name'=>'required|max:255|string',
            'slug'=>'required|string|unique:categories,slug,'.$this->route('category')->id,
        ];
    }
}
