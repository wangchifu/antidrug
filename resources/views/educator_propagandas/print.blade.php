@extends('layouts.master_print')

@section('content')
    <h2 class="text-center">各校毒品防制宣導活動成果上傳(教育人員)-成果</h2>
    <table class="table table-striped">
        <tr>
            <td nowrap>
                <strong>機關/單位名稱</strong>
            </td>
            <td colspan="3" nowrap>
                @if(!empty($educator_propaganda->school_code))
                    {{ $schools[$educator_propaganda->school_code] }}
                @else
                    {{ $educator_propaganda->name }}
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
                <strong>講座</strong>
            </td>
            <td colspan="3" nowrap>
                {{ $educator_propaganda->lecture }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>辦理日期</strong>
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
    活動照片：<br>
    <div class="container">
        <div class="row">
            @foreach($pics as $pic)
                @if(file_exists(storage_path('app/public/educator_propagandas/'.$educator_propaganda->id.'/'.$pic->pic)))
                    <div class="col-5" style="margin: 5px">
                        <figure class="figure">
                            <img src="{{ asset('storage/educator_propagandas/'.$educator_propaganda->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
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
