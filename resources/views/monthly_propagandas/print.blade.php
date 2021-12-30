@extends('layouts.master_print')

@section('content')
    <h2 class="text-center">每月反毒宣導績效表-成果</h2>
    <table class="table table-striped" style="border: 3px solid #000;border-collapse: collapse;">
        <tr>
            <td nowrap>
                <strong>機關/單位名稱</strong>
            </td>
            <td colspan="3">
                @if(!empty($monthly_propaganda->user->school_code))
                    {{ $schools[$monthly_propaganda->user->school_code] }}
                @else
                    {{ $monthly_propaganda->user->name }}
                @endif
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導主題</strong>
            </td>
            <td colspan="3">
                {{ $monthly_propaganda->title }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導日期</strong>
            </td>
            <td nowrap>
                {{ $monthly_propaganda->date }}
            </td>
            <td nowrap>
                <strong>宣導對象</strong>
            </td>
            <td nowrap>
                {{ $objects[$monthly_propaganda->object] }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導類別</strong>
            </td>
            <td nowrap>
                {{ $types[$monthly_propaganda->type] }}
            </td>
            <td nowrap>
                <strong>宣導人員</strong>
            </td>
            <td nowrap>
                {{ $monthly_propaganda->personnel }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導地點</strong>
            </td>
            <td nowrap>
                {{ $monthly_propaganda->place }}
            </td>
            <td nowrap>
                <strong>宣導人次</strong>
            </td>
            <td nowrap>
                {{ $monthly_propaganda->person_times }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導場次</strong>
            </td>
            <td nowrap colspan="3">
                {{ $monthly_propaganda->times }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導內容</strong>
            </td>
            <td colspan="3">
                {!! nl2br($monthly_propaganda->content) !!}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導成效</strong>
            </td>
            <td colspan="3">
                {{ $monthly_propaganda->result }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>經費來源</strong>
            </td>
            <td>
                {{ $monthly_propaganda->money_source }}
            </td>
            <td nowrap>
                <strong>經費總額</strong>
            </td>
            <td nowrap>
                {{ $monthly_propaganda->money }}
            </td>
        </tr>
    </table>
    活動照片：<br>
    <div class="container">
        <div class="row">
            @foreach($pics as $pic)
                @if(file_exists(storage_path('app/public/monthly_propagandas/'.$monthly_propaganda->id.'/'.$pic->pic)))
                    <div class="col-5" style="margin: 5px">
                        <figure class="figure">
                            <img src="{{ asset('storage/monthly_propagandas/'.$monthly_propaganda->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
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
