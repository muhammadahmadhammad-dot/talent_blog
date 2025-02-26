@if (session('error'))
    <div class="alert alert-danger card-sub alert-dismissible fade show" role="alert">
       <p class="p-0 m-0"> {{ session('error') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success card-sub alert-dismissible fade show" role="alert" >
        <p class="p-0 m-0">
            {{ session('success') }}
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
