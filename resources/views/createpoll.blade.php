@extends('layouts.layout')

@section('title')
    Create Polling
@endsection

@section('content')
    <div style="height: 90vh" class="d-flex align-items-center justify-content-center flex-column">

        {{-- @error('choises.*')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}
        @if (session('pollingCreated'))
            <div class="alert alert-success" style="width: 25rem">
                {{session('pollingCreated')}}
            </div>
        @endif


        <div class="card" style="width: 25rem">
            <div class="card-header" style="background-color: white">
                <h3>Create Polling</h3>
            </div>

            <div class="card-body">
                <form action="" method="post">
                    @method('post')
                    @csrf
                    <label for="title">Title : </label>
                    <input id="title" type="text"
                        class="form-control @error('title')
                        {{ 'is-invalid' }}
                    @enderror"
                        name="title" placeholder="Title">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <label>Choises : </label>
                    <div id="inputs">
                        <input type="text" name="choises[]"
                            class="form-control mb-2 @error('choises.*') {{ 'is-invalid' }}@enderror">
                        @error('choises.*')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="d-flex justify-content-end">
                        <span class="btn btn-primary btn-sm my-3" id="add-input">Add Input</span>
                    </div>

                    <label for="deadline">Deadline : </label>
                    <input type="datetime-local" id="deadline"
                        class="form-control @error('deadline') {{ 'is-invalid' }}@enderror" name="deadline">

                    @error('deadline')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const inputs = document.getElementById('inputs')
        const btnAddInput = document.getElementById('add-input')

        btnAddInput.addEventListener('click', () => {
            const newInput = document.createElement('input')
            newInput.type = 'text'
            newInput.name = 'choises[]'
            newInput.classList.add('form-control')
            newInput.classList.add('mb-2')

            inputs.appendChild(newInput)
        })
    </script>
@endsection
