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
                        <a href="{{route('blog.index')}}">Blog </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit </a>
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
                                        <a href="{{route('blog.index')}}" class="btn text-white btn-danger">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Back
                                          </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('includes._message')
                           <div>
                            <form action="{{ route('category.update', $item->id) }}" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" value="{{ old('name', $item->name) }}" name="name"
                                        placeholder="Category Name">
                                    @error('name')
                                        <p class="text-danger fs-6">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control" value="{{ old('slug', $item->slug) }}" name="slug"
                                        placeholder="Category Slug">
                                    @error('slug')
                                        <p class="text-danger fs-6">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="submit" value="Save Changes" class="btn btn-success">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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

