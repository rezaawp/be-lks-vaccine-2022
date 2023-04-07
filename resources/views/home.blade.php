@extends('layouts.layout')

@section('title')
    Home
@endsection

@section('content')
    <div class="row">
        @if (count($pollings) <= 0)
            <div class="d-flex align-items-center justify-content-center" style="height: 90vh">
                <h3 class="text-center">Data polling belum dapat kami temukan</h3>
            </div>
        @else
            @foreach ($pollings as $item)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $item['title'] }}</h4>
                        </div>

                        <div class="card-body">
                            <span>- Polling ini memilik 3 pilihan</span> <br>
                            <span>- 10 orang sudah menjawab polling ini</span>

                            <div class="mt-4 d-flex justify-content-end">
                                <a href="/poll/{{ $item['id'] }}" class="btn btn-primary">Vote</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
