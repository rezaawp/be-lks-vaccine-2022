@extends('layouts.layout')

@section('title')
    Polling
@endsection

@section('content')
    <div class="row p-3">
        <h5><span class="badge bg-success">Polling</span></h5>

        <h2 class="fw-bold">{{ $polling['title'] }}</h2>

        <span>Dibuat oleh <span class="fw-bold">{{ $polling['user']['name'] . ' ' }}</span>{{ $created_at }}</span> <br>
        <span><small>Klik pilihan dibawah ini untuk memilih</small></span>
    </div>

    <div class="container-fluid mt-3">
        <form action="/voted" method="post">
            <input type="text" class="d-none" name="pollingId" value={{ $pollingId }}>
            <div class="row">
                @csrf
                @method('post')

                @if (session('voted'))
                    <div class="alert alert-success">{{ session('voted') }}</div>
                @endif

                @if (session('voteunique'))
                    <div class="alert alert-danger">{{ session('voteunique') }}</div>
                @endif

                @error('voteError')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @error('choisesRequired')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="col-md-8">
                    <div class="row">
                        @foreach ($polling['choises'] as $choise)
                            <div class="col-12 mb-3">
                                <label for="choise-{{ $choise['id'] }}" style="width: 100%">
                                    <div class="card p-3">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="fw-bold d-flex flex-row">
                                                {{ $choise['choise'] }}
                                                @if (!$voted)
                                                    <div class="form-check ms-2">
                                                        <input type="radio" name="choises"
                                                            id="choise-{{ $choise['id'] }}" class="form-check-input"
                                                            value={{ $choise['id'] }}>
                                                    </div>
                                                @endif
                                            </h5>

                                            @if (session('voted') || $voted)
                                                <h6><span class="badge bg-warning">35%</span></h6>
                                            @endif
                                        </div>
                                        @if (session('voted') || $voted)
                                            <div class="progress">
                                                <div class="progress-bar bg-success" style="width: 25%"></div>
                                            </div>
                                        @endif
                                    </div>

                                </label>
                            </div>
                        @endforeach


                    </div>
                </div>

                <div class="col-md-4">
                    <button class="btn btn-success mt-2" style="width: 100%" type="submit">Kirim Vote Saya</button>

                    <div class="bg-light mt-2 ps-3 pt-3" style="padding-bottom: 13%">
                        <b>Votes</b>
                        <h1 class="fw-bold">
                            80
                        </h1>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
