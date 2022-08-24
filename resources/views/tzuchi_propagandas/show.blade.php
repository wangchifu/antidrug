@extends('layouts.master')

@section('content')
    @auth
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            @if(auth()->user()->admin == 1)
                <li class="breadcrumb-item"><a href="{{ route('tzuchi_propagandas.review') }}">「慈濟宣導」管理列表</a></li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('tzuchi_propagandas.index') }}">「慈濟宣導」列表</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $tzuchi_propaganda->title }}</li>
        </ol>
    </nav>
    @endauth
    <a href="#" onclick="history.back()" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
    <a href="{{ route('tzuchi_propagandas.print',$tzuchi_propaganda->id) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-print"></i> 列印</a>
    <table class="table table-striped">
        <tr>
            <td nowrap>
                <strong>機關/單位名稱</strong>
            </td>
            <td colspan="3">
                @if(!empty($tzuchi_propaganda->school_code))
                    {{ $schools[$tzuchi_propaganda->school_code] }}
                @else
                    {{ $tzuchi_propaganda->user->name }}
                @endif
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>講題</strong>
            </td>
            <td colspan="3">
                {{ $tzuchi_propaganda->title }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>講師</strong>
            </td>
            <td colspan="3">
                {{ $tzuchi_propaganda->lecture }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>辦理日期時間</strong>
            </td>
            <td nowrap>
                {{ $tzuchi_propaganda->date }}
            </td>
            <td nowrap>
                <strong>活動地點</strong>
            </td>
            <td nowrap>
                {{ $tzuchi_propaganda->place }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>參加人數</strong>
            </td>
            <td colspan="3" nowrap>
                教職員：
                {{ $tzuchi_propaganda->teacher_times }}人
                @if($tzuchi_propaganda->student_times > 0)
                    ，學生：{{ $tzuchi_propaganda->student_times }}人
                @endif
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>實施情形與效益評估</strong>
            </td>
            <td colspan="3">
                {!! nl2br($tzuchi_propaganda->report) !!}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>檢討與建議</strong>
            </td>
            <td colspan="3">
                {!! nl2br($tzuchi_propaganda->content) !!}
            </td>
        </tr>
    </table>
    <div class="container">
        <div class="row">
            @foreach($pics as $pic)
                @if(file_exists(storage_path('app/public/tzuchi_propagandas/'.$tzuchi_propaganda->id.'/'.$pic->pic)))
                    <div class="col-5" style="margin: 5px">
                        <figure class="figure">
                            <a href="{{ asset('storage/tzuchi_propagandas/'.$tzuchi_propaganda->id.'/'.$pic->pic) }}" class="venobox" data-gall="gall1">
                                <img src="{{ asset('storage/tzuchi_propagandas/'.$tzuchi_propaganda->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
                            </a>
                            <figcaption class="figure-caption">{{ $pic->pic_desc }}</figcaption>
                        </figure>
                    </div>
                @else
                    照片遺失 ({{ $pic->pic }})<br>
                @endif
            @endforeach
        </div>
    </div>
@endsection
