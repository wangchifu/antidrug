@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="py-2">
                {{ $article->title }}
            </h3>
        </div>
        <div class="card-body">
            {!! $article->content !!}
        </div>
    </div>
@endsection
