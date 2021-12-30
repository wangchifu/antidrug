@extends('layouts.master_print')

@section('content')
    <h2 class="text-center">反毒中心學校-成果</h2>
    <table class="table table-striped">
        <tr>
            <td nowrap>
                <strong>機關/單位名稱</strong>
            </td>
            <td colspan="3">
                @if(!empty($center_active->school_code))
                    {{ $schools[$center_active->school_code] }}
                @else
                    {{ $center_active->name }}
                @endif
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>活動主題</strong>
            </td>
            <td colspan="3">
                {{ $center_active->title }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>活動日期</strong>
            </td>
            <td nowrap>
                {{ $center_active->date }}
            </td>
            <td nowrap>
                <strong>宣導地點</strong>
            </td>
            <td nowrap>
                {{ $center_active->place }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>參與人次</strong>
            </td>
            <td nowrap>
                {{ $center_active->person_times }}
            </td>
            <td nowrap>
                <strong>成果檔案</strong>
            </td>
            <td>
                @if(!empty($center_active->filename))
                    @if(file_exists(storage_path('app/public/center_actives/'.$center_active->id.'/'.$center_active->filename)))
                        <a href="{{ asset('storage/center_actives/'.$center_active->id.'/'.$center_active->filename) }}" target="_blank"><i class="fas fa-download text-primary"></i></a>
                    @else
                        檔案遺失
                    @endif
                @endif
            </td>
        </tr>
    </table>
    活動照片：<br>
    <div class="container">
        <div class="row">
            @foreach($pics as $pic)
                @if(file_exists(storage_path('app/public/center_actives/'.$center_active->id.'/'.$pic->pic)))
                    <div class="col-5" style="margin: 5px">
                        <figure class="figure">
                            <img src="{{ asset('storage/center_actives/'.$center_active->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
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
