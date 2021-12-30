@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/key.svg') }}" height="24">
                變更密碼
            </h5>
        </div>
        <div class="card-body">
            @include('layouts.form_errors')
            @if(auth()->user()->type=='local')
                <form action="{{ route('update_pwd') }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="exampleInputPassword0">舊密碼*</label>
                        <input type="password" class="form-control" name="password0" id="exampleInputPassword0" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">新密碼*</label>
                        <input type="password" class="form-control" name="password1" id="exampleInputPassword1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">確認新密碼*</label>
                        <input type="password" class="form-control" name="password2" id="exampleInputPassword2" required>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('確定嗎？')">送出</button>
                </form>
            @elseif(auth()->user()->type=='gsuite')
                使用 GSuite 登入，登入校務系統 <a href="https://cloudschool.chc.edu.tw" target="_blank">cloudschool</a> 更改，本站密碼即同步。
            @endif
        </div>
    </div>
@endsection
