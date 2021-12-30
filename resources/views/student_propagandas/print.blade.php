@extends('layouts.master_print')

@section('content')
    <h2 class="text-center">各校毒品防制宣導活動成果上傳(學生)-成果</h2>
    <table class="table table-striped">
        <tr>
            <td nowrap>
                <strong>機關/單位名稱</strong>
            </td>
            <td colspan="3">
                @if(!empty($student_propaganda->school_code))
                    {{ $schools[$student_propaganda->school_code] }}
                @else
                    {{ $student_propaganda->name }}
                @endif
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>講題</strong>
            </td>
            <td colspan="3">
                {{ $student_propaganda->title }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>講座</strong>
            </td>
            <td colspan="3">
                {{ $student_propaganda->lecture }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>辦理日期</strong>
            </td>
            <td nowrap>
                {{ $student_propaganda->date }}
            </td>
            <td nowrap>
                <strong>活動地點</strong>
            </td>
            <td nowrap>
                {{ $student_propaganda->place }}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>參加人數</strong>
            </td>
            <td colspan="3" nowrap>
                教職員：
                {{ $student_propaganda->teacher_times }}人
                @if($student_propaganda->student_times > 0)
                    ，學生：{{ $student_propaganda->student_times }}人
                @endif
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>實施情形與效益評估</strong>
            </td>
            <td colspan="3">
                {!! nl2br($student_propaganda->report) !!}
            </td>
        </tr>
        <tr>
            <td nowrap>
                <strong>檢討與建議</strong>
            </td>
            <td colspan="3">
                {!! nl2br($student_propaganda->content) !!}
            </td>
        </tr>
    </table>
    活動照片：<br>
    <div class="container">
        <div class="row">
            @foreach($pics as $pic)
                @if(file_exists(storage_path('app/public/student_propagandas/'.$student_propaganda->id.'/'.$pic->pic)))
                    <div class="col-5" style="margin: 5px">
                        <figure class="figure">
                            <img src="{{ asset('storage/student_propagandas/'.$student_propaganda->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
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
