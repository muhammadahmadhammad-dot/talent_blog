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
                        <a href="#">Blog Detail </a>
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
                            <div class="table-responsive">
                                <table class="table table-bordered  mt-3">


                                    <tbody>
                                        <tr>
                                            <th width="150px">Title</th>
                                            <td>{{ Str::title($blog->title) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Slug</th>
                                            <td>{{ $blog->slug }}</td>
                                        </tr>
                                        <tr>
                                            <th>Category</th>
                                            <td>{{ $blog->category ? $blog->category->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>date</th>
                                            <td>{{ $blog->date }}</td>
                                        </tr>
                                        @if ($blog->image_caption)
                                            <tr>
                                                <th>Image Caption</th>
                                                <td>{{ $blog->image_caption }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <h5>Short Description</h5>
                                    <p>{{ $blog->short_description }}</p>
                                </div>
                                <div class="mb-3">
                                    <h5>Description</h5>
                                    <p>{{ $blog->description }}</p>
                                </div>
                            </div>
                            @if ($blog->image)
                                <div>
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="">
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <form action="{{route('blog.destroy',$blog->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit">
                                    <span class="btn-label">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                    Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
