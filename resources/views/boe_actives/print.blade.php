@extends('layouts.master_print')

@section('content')
    <h2 class="text-center">教育處自辦活動-成果</h2>
    <table class="table table-striped">
        <tr>
            <td nowrap>
                <strong>機關/單位名稱</strong>
            </td>
            <td colspan="3">
                @if(!empty($boe_active->school_code))
                    {{ $schools[$boe_active->school_code] }}
                @else
                    {{ $boe_active->name }}
                @endif
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導主題</strong>
            </td>
            <td colspan="3">
                {{ $boe_active->title }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導日期</strong>
            </td>
            <td nowrap>
                {{ $boe_active->date }}
            </td>
            <td nowrap>
                <strong>宣導對象</strong>
            </td>
            <td nowrap>
                {{ $objects[$boe_active->object] }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導類別</strong>
            </td>
            <td nowrap>
                {{ $types[$boe_active->type] }}
            </td>
            <td nowrap>
                <strong>宣導人員</strong>
            </td>
            <td nowrap>
                {{ $boe_active->personnel }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導地點</strong>
            </td>
            <td nowrap>
                {{ $boe_active->place }}
            </td>
            <td nowrap>
                <strong>宣導人次</strong>
            </td>
            <td nowrap>
                {{ $boe_active->person_times }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>宣導內容</strong>
            </td>
            <td>
                {!! nl2br($boe_active->content) !!}
            </td>
            <td nowrap>
                <strong>宣導成效</strong>
            </td>
            <td>
                {{ $boe_active->result }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>經費來源</strong>
            </td>
            <td nowrap>
                {{ $boe_active->money_source }}
            </td>
            <td nowrap>
                <strong>經費總額</strong>
            </td>
            <td>
                {{ $boe_active->money }}
            </td>
        </tr>
    </table>
    活動照片：<br>
    <div class="container">
        <div class="row">
            @foreach($pics as $pic)
                @if(file_exists(storage_path('app/public/boe_actives/'.$boe_active->id.'/'.$pic->pic)))
                    <div class="col-5" style="margin: 5px">
                        <figure class="figure">
                            <img src="{{ asset('storage/boe_actives/'.$boe_active->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
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
