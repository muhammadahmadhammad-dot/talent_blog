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
                        <a href="#">Blog </a>
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
                                        <a href="{{route('blog.create')}}" class="btn text-white btn-secondary">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Create
                                          </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('includes._message')
                            <div class="table-responsive">
                                <table class="table mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="80px">#</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th scope="col" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($blogs as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->category ? $item->category->name : ''  }}</td>
                                                <td>{{ $item->date }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                      <a href="{{route('blog.show',$item->id)}}" class="me-2  text-white btn btn-info">
                                                        <span class="btn-label">
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                        View
                                                      </a>
                                                      <a  href="{{route('blog.edit',$item->id)}}" class="  text-white btn btn-black">
                                                        <span class="btn-label">
                                                            <i class="fas fa-pen"></i>
                                                        </span>
                                                        Edit
                                                      </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <p class="text-danger text-center m-0 ">No Item</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
