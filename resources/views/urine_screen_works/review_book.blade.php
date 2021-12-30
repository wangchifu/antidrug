@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('urine_screen_works.review') }}">「執行擴大尿篩工作填報」管理列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯同意參加擴大尿篩人員名冊</li>
        </ol>
    </nav>
    <a href="#" onclick="history.back()" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/urine_work.png') }}" height="40">
                同意參加擴大尿篩人員名冊
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th nowrap>
                        單位
                    </th>
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
                </tr>
                </thead>
                <tbody>
                @foreach($urine_screen_work_members as $urine_screen_work_member)
                    <tr>
                        <td nowrap>
                            @if(!empty($urine_screen_work_member->urine_screen_work->user->school_code))
                                {{ $schools[$urine_screen_work_member->urine_screen_work->user->school_code] }}
                            @else
                                {{ $urine_screen_work_member->urine_screen_work->user->name }}
                            @endif
                        </td>
                        <td nowrap>
                            {{ $urine_screen_work_member->class }}
                        </td>
                        <td nowrap>
                            {{ $urine_screen_work_member->number }}
                        </td>
                        <td nowrap>
                            {{ $urine_screen_work_member->name }}
                        </td>
                        <td nowrap>
                            {{ $urine_screen_work_member->sex }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
