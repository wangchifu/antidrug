@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('urine_screen_works.index') }}">「執行擴大尿篩工作填報」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯同意參加擴大尿篩人員名冊</li>
        </ol>
    </nav>
    <a href="#" onclick="history.back()" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/urine_work.png') }}" height="40">
                匯入同意參加擴大尿篩人員名冊
            </h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>機關/單位/名稱</label><br>
                @if(!empty(auth()->user()->school_code))
                    {{ $schools[auth()->user()->school_code] }}
                @else
                    {{ auth()->user()->name }}
                @endif
            </div>
            {{ Form::open(['route' => 'urine_screen_works.import_member', 'method' => 'post','files'=>true]) }}
            <div class="form-group">
                <label for="date">調查日期<strong class="text-danger">*</strong>
                </label><br>
                {{ $urine_screen_work->date }}
            </div>
            <div class="form-group">
                <label for="file">
                    同意參加擴大尿篩人員名冊 [範本下載 <a href="{{ asset('files/同意參加擴大尿篩人員名冊.xlsx') }}" target="_blank"><i class="fas fa-download text-primary"></i></a>] <strong class="text-danger">*</strong>
                    <small class="text-secondary">(限 xlsx 檔)</small>
                </label>
                {{ Form::file('file', ['class' => 'form-control','required'=>'required','accept'=>'.xlsx']) }}
            </div>
                <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 大量匯入同意名冊</button>
                <input type="hidden" name="urine_screen_work_id" value="{{ $urine_screen_work->id }}">
                <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
            <hr>
            <h4>同意參加擴大尿篩人員名冊列表</h4>
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th nowrap>
                        班級
                    </th>
                    <th nowrap>
                        學號
                    </th>
                    <th nowrap>
                        姓名
                    </th>
                    <th nowrap>
                        性別
                    </th>
                    <th nowrap>
                        動作
                    </th>
                </tr>
                </thead>
                <tbody>
                {{ Form::open(['route' => 'urine_screen_works.store_member', 'method' => 'post']) }}
                <tr>
                    <td>
                        <input type="text" class="form-control" name="class" id="class" required>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="number" id="number" required>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </td>
                    <td>
                        {{ Form::select('sex',$sexs,null,['id'=>'sex','class' => 'form-control','required'=>'required']) }}
                    </td>
                    <td nowrap>
                        <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-plus-circle"></i> 單筆增加</button>
                    </td>
                </tr>
                <input type="hidden" name="urine_screen_work_id" value="{{ $urine_screen_work->id }}">
                {{ Form::close() }}
                @foreach($urine_screen_work_members as $urine_screen_work_member)
                    <tr>
                        <td>
                            {{ $urine_screen_work_member->class }}
                        </td>
                        <td>
                            {{ $urine_screen_work_member->number }}
                        </td>
                        <td>
                            {{ $urine_screen_work_member->name }}
                        </td>
                        <td>
                            {{ $urine_screen_work_member->sex }}
                        </td>
                        <td>
                            <a href="{{ route('urine_screen_works.delete_member',$urine_screen_work_member->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除此筆</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
