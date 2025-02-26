@extends('layouts.app')
@section('content')
       <!-- Page Header-->
       <header class="masthead" style="background-image: url('{{ asset('assets/frontend/assets/img/home-bg.jpg') }} ')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <span class="subheading">A Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                @if (count($blogs) > 0)
                    @foreach ($blogs as $blog)
                        
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="{{route('blogs.detail',$blog->slug)}}">
                            <h2 class="post-title">{{Str::title($blog->title)}}</h2>
                            <h3 class="post-subtitle">{{Str::limit($blog->short_description,45,)}}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">{{$blog->user ? $blog->user->name : ''}}</a>
                            on {{$blog->created_at->diffForHumans()}}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    @endforeach
                @endif
                {{$blogs->links()}}
            </div>
        </div>
    </div>
@endsection