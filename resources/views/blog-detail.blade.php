@extends('layouts.app')
@section('title', '- ' . Str::limit(Str::title($blog->title), 25, '...'))
@section('content')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('assets/frontend/assets/img/post-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h1>{{ Str::limit(Str::title($blog->title), 25, '...') }}</h1>
                        <h2 class="subheading">{{ Str::limit($blog->short_description, 25, '...') }}</h2>
                        <span class="meta">
                            Posted by
                            <a href="#!">{{ $blog->user ? $blog->user->name : '' }}</a>
                            on {{ $blog->created_at->format('M d, Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>{{ $blog->short_description }}</p>

                    @if ($blog->image)
                        <a href="#!"><img class="img-fluid" src="{{ asset('storage/' . $blog->image) }}"
                                alt="..." /></a>
                        <span class="caption text-muted">{{ $blog->image_caption }}</span>
                    @endif

                    <p>{{ $blog->description }}</p>
                </div>
            </div>
        </div>
    </article>
@endsection
