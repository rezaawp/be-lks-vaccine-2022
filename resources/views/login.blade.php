<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @include('assets.css')
</head>

<body>

    <div class="container-fluid d-flex flex-column align-items-center justify-content-center" style="height: 100vh">


        {{-- alert jika login gagal --}}
        @error('authGagal')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        {{-- alert register berhasil --}}
        @if (session('berhasilRegister'))
            <div class="alert alert-success">{{ session('berhasilRegister') }}</div>
        @endif

        <div class="card">
            {{-- <div class="progress">
                <div class="progress-bar bg-success" style="width: 90%" aria-valuemax="100">25%</div>
            </div> --}}
            <div class="card-header" style="background-color: white !important ">
                <h3 class="text-center fw-bold">LOGIN</h3>
            </div>

            <div class="card-body" style="width: 25rem">
                <form action="" method="post" autocomplete="off">
                    @csrf
                    @method('post')
                    <label for="email">Email : </label>
                    <input type="text" name="email" value="{{ old('email') }}"
                        class="form-control @error('email'){{ 'is-invalid' }}@enderror" placeholder="Email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="password">Password : </label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password')
                        {{ 'is-invalid' }}
                    @enderror"
                        placeholder="Password">

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror


                    <div class="d-flex justify-content-between mt-3">
                        <span>Tidak punya akun{{ ' ' }}?{{ ' ' }}<a href="/register"
                                class="text-decoration-none">Register</a></span>
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @include('assets.js')
</body>

</html>
