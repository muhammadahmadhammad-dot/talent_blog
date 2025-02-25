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
                        <a href="#">Category </a>
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
                                        Category
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#createCategoryModel">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Create
                                        </button>
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
                                            <th scope="col">#</th>
                                            <th>Name</th>
                                            <th>slug</th>
                                            <th scope="col" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                      <button type="button" class="me-2 btn btn-black" data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModel{{$item->id}}">
                                                        <span class="btn-label">
                                                            <i class="fa fa-pencil"></i>
                                                        </span>
                                                        Edit
                                                    </button>
                                                    <form action="{{route('category.destroy',$item->id)}}" method="post">
                                                      @method('DELETE')
                                                      @csrf
                                                      <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                    </div>
                                                </td>
                                            </tr>

                                            {{-- start edit mdel --}}
                                            <div class="modal fade" id="editCategoryModel{{$item->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content ">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Category </h4>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('category.update', $item->id) }}"
                                                                method="post">
                                                                @method('PATCH')
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label class="form-label">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ old('name', $item->name) }}"
                                                                        name="name" placeholder="Category Name">
                                                                    @error('name')
                                                                        <p class="text-danger fs-6">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Slug</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ old('slug', $item->slug) }}"
                                                                        name="slug" placeholder="Category Slug">
                                                                    @error('slug')
                                                                        <p class="text-danger fs-6">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <input type="submit" value="Save Changes"
                                                                        class="btn btn-success">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end edit model --}}
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    <p class="text-danger">No Item</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- start create mdel --}}
    <div class="modal fade" id="createCategoryModel">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Create Category </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="{{ old('name') }}"  name="name"
                                placeholder="Category Name">
                            @error('name')
                                <p class="text-danger fs-6">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Save" class="btn btn-primary">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end create model --}}
@endsection
