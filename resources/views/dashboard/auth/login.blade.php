<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>{{config('app.name')}} | Login - Dashboard</title>
        <meta
          content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
          name="viewport"
        />
        <link
          rel="icon"
          href="{{ asset('assets/dashboard/img/kaiadmin/favicon.ico') }}"
          type="image/x-icon"
        />
    
         <!-- Fonts and icons -->
         <script src="{{asset('assets/dashboard/js/plugin/webfont/webfont.min.js')}}"></script>
         <script>
           WebFont.load({
             google: { families: ["Public Sans:300,400,500,600,700"] },
             custom: {
               families: [
                 "Font Awesome 5 Solid",
                 "Font Awesome 5 Regular",
                 "Font Awesome 5 Brands",
                 "simple-line-icons",
               ],
               urls: ["{{asset('assets/dashboard/css/fonts.min.css')}}"],
             },
             active: function () {
               sessionStorage.fonts = true;
             },
           });
         </script>
    
        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/dashboard/css/plugins.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/dashboard/css/kaiadmin.min.css') }}" />
    
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="{{ asset('assets/dashboard/css/demo.css') }}" />
      </head>

<body>
    <div class="d-flex  justify-content-center align-items-center" style="height: 100vh; ">
        <div class="card" style="width:320px;">
            <div class="card-header">
                <div class="card-title">
                    Login to {{config('app.name')}}
                </div>
                @include('includes._message')
            </div>
            <div class="card-body">
                <form action="{{route('loginCheck')}}" method="POST">
                   
                    <div class="form-group p-0 mb-3">
                        <label >Email Address</label>
                        <input
                        value="{{old('email')}}"
                          type="email"
                          class="form-control"
                          name="email"
                          placeholder="Enter Email"
                        />
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="form-group p-0 mb-3">
                        <label >Password</label>
                        <input
                        value="{{old('password')}}"
                          type="password"
                          class="form-control"
                          name="password"
                          placeholder="Password"
                        />
                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                      </div>
                      <div class="mb-3">
                        <button type="submit" class="btn w-100 btn-primary">
                            <span class="btn-label">
                                <i class="fas fa-sign-in-alt"></i>
                            </span>
                            Login</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>