@extends('layouts.master')

@section('content')
    <h3>

    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">全站帳號管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">修改本機帳號</li>
        </ol>
    </nav>
    <div class="card my-4">
        <h4 class="card-header">
            修改
            @if($user->admin ==1)
                系統管理者
            @else
                非管理者
            @endif
        </h4>
        <div class="card-body">
            <form action="{{ route('users.update',$user->id) }}" method="post">
                @if($user->admin==1)
                    @include('users.edit_form_admin')
                @else
                    @include('users.edit_form_user')
                @endif
            </form>
        </div>
    </div>
@endsection
