@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">全站帳號管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增本機帳號</li>
        </ol>
    </nav>
    <div class="card my-4">
        <h4 class="card-header">新增</h4>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="post">
            @include('users.create_form')
            </form>
        </div>
    </div>
@endsection
