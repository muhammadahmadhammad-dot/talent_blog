@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Dashboard</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Pages</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('blog.index') }}">Blog </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Create </a>
                    </li>
                </ul>
            </div>
            <div class="page-category">

                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-md-6">
                                        Blog
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <a href="{{ route('blog.index') }}" class="btn text-white btn-danger">
                                            Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('includes._message')
                            <div>
                                <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('title') }}"
                                            name="title" placeholder="Blog Title">
                                        @error('title')
                                            <p class="text-danger fs-6">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 my-1">
                                            <div class="mb-3">
                                                <label class="form-label">Select Category <span class="text-danger">*</span></label>
                                                <select name="category" class="form-select">
                                                    <option value="">Select --</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" @selected(old('category') == $category->id)>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                    <p class="text-danger fs-6">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 my-1">
                                            <div class="mb-3">
                                                <label class="form-label">Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" value="{{ old('date') }}"
                                                    name="date">
                                                @error('date')
                                                    <p class="text-danger fs-6">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image">
                                        @error('image')
                                            <p class="text-danger fs-6">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image Caption</label>
                                        <input type="text" class="form-control" value="{{ old('image_caption') }}"
                                            name="image_caption">
                                        @error('image_caption')
                                            <p class="text-danger fs-6">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Short Description <span class="text-danger">*</span></label>
                                        <textarea name="short_description" class="form-control" rows="2">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <p class="text-danger fs-6">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                        @error('description')
                                            <p class="text-danger fs-6">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
