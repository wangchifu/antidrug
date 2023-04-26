@extends('layouts.master_print')

@section('content')
    <h2 class="text-center">學校辦理毒品危害防制中心諮詢專線宣導-成果</h2>
    <table class="table table-striped">
        <tr>
            <td nowrap>
                <strong>機關/單位名稱</strong>
            </td>
            <td colspan="3">
                @if(!empty($telephone_propaganda->school_code))
                    {{ $schools[$telephone_propaganda->school_code] }}
                @else
                    {{ $telephone_propaganda->name }}
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
    活動照片：<br>
    <div class="container">
        <div class="row">
            @foreach($pics as $pic)
                @if(file_exists(storage_path('app/public/telephone_propagandas/'.$telephone_propaganda->id.'/'.$pic->pic)))
                    <div class="col-5" style="margin: 5px">
                        <figure class="figure">
                            <img src="{{ asset('storage/telephone_propagandas/'.$telephone_propaganda->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
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
