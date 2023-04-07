<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @include('assets.css')
</head>

<body>
    <div class="container-fluid d-flex flex-column align-items-center justify-content-center" style="height: 100vh">

        @error('registerError')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="card">
            <div class="card-header" style="background-color: white !important ">
                <h3 class="text-center fw-bold">REGISTER</h3>
            </div>

            <div class="card-body" style="width: 25rem">
                <form action="" method="post" autocomplete="off">
                    @csrf
                    @method('post')
                    <label for="name">Nama Lengkap : </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name'){{ 'is-invalid' }}@enderror" placeholder="Nama Lengkap">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <label for="email" class="mt-2">Email : </label>
                    <input type="text" name="email" value="{{ old('email') }}"
                        class="form-control @error('email'){{ 'is-invalid' }}@enderror" placeholder="Email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <label for="password" class="mt-2">Password : </label>
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

                    <label for="password2" class="mt-2">Konfirmasi Password : </label>
                    <input type="password" id="password2" name="password2"
                        class="form-control @error('password2')
                        {{ 'is-invalid' }}
                    @enderror"
                        placeholder="Konfirmasi Password">

                    @error('password2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="d-flex justify-content-between mt-3">
                        <span>Sudah punya akun{{ ' ' }}?{{ ' ' }}<a href="/login"
                                class="text-decoration-none">Login</a></span>
                        <button class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @include('assets.js')
</body>

</html>
