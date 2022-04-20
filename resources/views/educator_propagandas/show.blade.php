@extends('layouts.master')

@section('content')
    @auth
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            @if(auth()->user()->admin == 1)
                <li class="breadcrumb-item"><a href="{{ route('educator_propagandas.review') }}">「教育人員宣導」管理列表</a></li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('educator_propagandas.index') }}">「教育人員宣導」列表</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $educator_propaganda->title }}</li>
        </ol>
    </nav>
    @endauth
    <a href="#" onclick="history.back()" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
    <a href="{{ route('educator_propagandas.print',$educator_propaganda->id) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-print"></i> 列印</a>
    <table class="table table-striped">
        <tr>
            <td nowrap>
                <strong>機關/單位名稱</strong>
            </td>
            <td colspan="3" nowrap>
                @if(!empty($educator_propaganda->school_code))
                    {{ $schools[$educator_propaganda->school_code] }}
                @else
                    {{ $educator_propaganda->user->name }}
                @endif
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>講題</strong>
            </td>
            <td colspan="3">
                {{ $educator_propaganda->title }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>講師</strong>
            </td>
            <td colspan="3" nowrap>
                {{ $educator_propaganda->lecture }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>辦理日期時間</strong>
            </td>
            <td nowrap>
                {{ $educator_propaganda->date }}
            </td>
            <td nowrap>
                <strong>活動地點</strong>
            </td>
            <td nowrap>
                {{ $educator_propaganda->place }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>參加人數</strong>
            </td>
            <td colspan="3" nowrap>
                教職員：
                {{ $educator_propaganda->teacher_times }}人
                @if($educator_propaganda->student_times > 0)
                    ，學生：{{ $educator_propaganda->student_times }}人
                @endif
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>檢討與建議</strong>
            </td>
            <td colspan="3">
                {!! nl2br($educator_propaganda->content) !!}
            </td>
        </tr>
    </table>
    <div class="container">
        <div class="row">
            @foreach($pics as $pic)
                @if(file_exists(storage_path('app/public/educator_propagandas/'.$educator_propaganda->id.'/'.$pic->pic)))
                    <div class="col-5" style="margin: 5px">
                        <figure class="figure">
                            <a href="{{ asset('storage/educator_propagandas/'.$educator_propaganda->id.'/'.$pic->pic) }}" class="venobox" data-gall="gall1">
                                <img src="{{ asset('storage/educator_propagandas/'.$educator_propaganda->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
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
