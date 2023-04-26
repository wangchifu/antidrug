@extends('layouts.master')

@section('content')
    @auth
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            @if(auth()->user()->admin==1)
                <li class="breadcrumb-item"><a href="{{ route('telephone_propagandas.review') }}">「毒品危害防制中心諮詢專線宣導」管理列表</a></li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('telephone_propagandas.index') }}">「毒品危害防制中心諮詢專線宣導」列表</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $telephone_propaganda->title }}</li>
        </ol>
    </nav>
    @endauth
    <a href="#" onclick="history.back()" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
    <a href="{{ route('telephone_propagandas.print',$telephone_propaganda->id) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-print"></i> 列印</a>
    <table class="table table-striped">
        <tr>
            <td nowrap>
                <strong>機關/單位名稱</strong>
            </td>
            <td colspan="3">
                @if(!empty($telephone_propaganda->school_code))
                    {{ $schools[$telephone_propaganda->school_code] }}
                @else
                    {{ $telephone_propaganda->user->name }}
                @endif
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導主題</strong>
            </td>
            <td colspan="3">
                {{ $telephone_propaganda->title }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導日期</strong>
            </td>
            <td>
                {{ $telephone_propaganda->date }}
            </td>
            <td nowrap>
                <strong>宣導對象</strong>
            </td>
            <td>
                {{ $objects[$telephone_propaganda->object] }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導類別</strong>
            </td>
            <td>
                {{ $types[$telephone_propaganda->type] }}
            </td>
            <td nowrap>
                <strong>宣導人員</strong>
            </td>
            <td>
                {{ $telephone_propaganda->personnel }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導地點</strong>
            </td>
            <td>
                {{ $telephone_propaganda->place }}
            </td>
            <td nowrap>
                <strong>宣導人次</strong>
            </td>
            <td>
                {{ $telephone_propaganda->person_times }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導場次</strong>
            </td>
            <td nowrap colspan="3">
                {{ $telephone_propaganda->times }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導內容</strong>
            </td>
            <td>
                {!! nl2br($telephone_propaganda->content) !!}
            </td>
            <td nowrap>
                <strong>宣導成效</strong>
            </td>
            <td>
                {{ $telephone_propaganda->result }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>經費來源</strong>
            </td>
            <td>
                {{ $telephone_propaganda->money_source }}
            </td>
            <td nowrap>
                <strong>經費總額</strong>
            </td>
            <td>
                {{ $telephone_propaganda->money }}
            </td>
        </tr>
    </table>
    <div class="container">
        <div class="row">
            @foreach($pics as $pic)
                @if(file_exists(storage_path('app/public/telephone_propagandas/'.$telephone_propaganda->id.'/'.$pic->pic)))
                    <div class="col-5" style="margin: 5px">
                        <figure class="figure">
                            <a href="{{ asset('storage/telephone_propagandas/'.$telephone_propaganda->id.'/'.$pic->pic) }}" class="venobox" data-gall="gall1">
                                <img src="{{ asset('storage/telephone_propagandas/'.$telephone_propaganda->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
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
