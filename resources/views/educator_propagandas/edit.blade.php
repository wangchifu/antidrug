@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('educator_propagandas.index') }}">「教育人員宣導」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯資料</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/teacher.png') }}" height="40">
                各校毒品防制宣導活動成果上傳(學生)
            </h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>機關/單位/名稱</label><br>
                @if(!empty(auth()->user()->school_code))
                    {{ $schools[auth()->user()->school_code] }}
                @else
                    {{ auth()->user()->name }}
                @endif
            </div>
            {{ Form::open(['route' => ['educator_propagandas.update',$educator_propaganda->id], 'method' => 'post', 'files' => true]) }}
            <div class="form-group">
                <label for="title">講題<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="title" id="title" required value="{{ $educator_propaganda->title }}">
            </div>
            <div class="form-group">
                <label for="lecture">講座<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="lecture" id="lecture" required value="{{ $educator_propaganda->lecture }}">
            </div>
            <div class="form-group">
                <label for="date">辦理日期<strong class="text-danger">*</strong></label>
                <input type="date" class="form-control" name="date" id="date" required maxlength="10" value="{{ $educator_propaganda->date }}">
            </div>
            <div class="form-group">
                <label for="place">活動地點<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="place" id="place" required value="{{ $educator_propaganda->place }}">
            </div>
            <div class="form-group">
                <label for="teacher_times">教師參加人數<strong class="text-danger">*</strong></label>
                <input type="number" class="form-control" name="teacher_times" id="teacher_times" required value="{{ $educator_propaganda->teacher_times }}">
            </div>
            <div class="form-group">
                <label for="student_times">學生參加人數<strong class="text-danger">*</strong></label>
                <input type="number" class="form-control" name="student_times" id="student_times" required value="{{ $educator_propaganda->student_times }}">
            </div>
            <div class="form-group">
                <label for="content">檢討與建議<strong class="text-danger">*</strong></label>
                <textarea name="content" id="content" required class="form-control">{{ $educator_propaganda->content }}</textarea>
            </div>
            <a name="pic_group"></a>
            <div class="form-group">
                <label>
                    已上傳的附圖
                </label>
                <div class="container">
                    <div class="row">
                        @foreach($pics as $pic)
                            @if(file_exists(storage_path('app/public/educator_propagandas/'.$educator_propaganda->id.'/'.$pic->pic)))
                                <div class="col-3" style="margin: 5px">
                                    <figure class="figure">
                                        <a href="{{ route('educator_propagandas.del_pic',$pic->id) }}" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle text-danger"></i></a>
                                        <img src="{{ asset('storage/educator_propagandas/'.$educator_propaganda->id.'/'.$pic->pic) }}" class="figure-img img-fluid rounded" alt="...">
                                        <figcaption class="figure-caption"><input type="text" placeholder="照片說明" name="pics_desc[{{ $pic->id }}]" value="{{ $pic->pic_desc }}"></figcaption>
                                    </figure>
                                </div>
                            @else
                                照片遺失 ({{ $pic->pic }})<br>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="pics[]">
                    增加附圖(用ctrl可多選)
                </label>
                {{ Form::file('pics[]', ['class' => 'form-control','multiple'=>'multiple','accept'=>'image/*']) }}
            </div>
            <hr>
            <div class="form-group">
                <label for="feedback">教師回饋單(份)<strong class="text-danger">*</strong></label>
                <input type="number" class="form-control" name="feedback" id="feedback" required value="{{ $educator_propaganda->feedback }}">
            </div>
            <div class="form-group">
                <table class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>選項</th>
                        <th>非常有幫助</th>
                        <th>有幫助</th>
                        <th>普通</th>
                        <th>沒幫助</th>
                        <th>完全沒幫助</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1.增進您了解藥物濫用種類及毒品外觀，感到?</td>
                        <td>
                            <input class="form-control" type="number" name="q_1_1" required value="{{ $educator_propaganda->q_1_1 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_1_2" required value="{{ $educator_propaganda->q_1_2 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_1_3" required value="{{ $educator_propaganda->q_1_3 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_1_4" required value="{{ $educator_propaganda->q_1_4 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_1_5" required value="{{ $educator_propaganda->q_1_5 }}">
                        </td>
                    </tr>
                    <tr>
                        <td>2.增進您對毒品危害認知，感到?</td>
                        <td>
                            <input class="form-control" type="number" name="q_2_1" required value="{{ $educator_propaganda->q_2_1 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_2_2" required value="{{ $educator_propaganda->q_2_2 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_2_3" required value="{{ $educator_propaganda->q_2_3 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_2_4" required value="{{ $educator_propaganda->q_2_4 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_2_5" required value="{{ $educator_propaganda->q_2_5 }}">
                        </td>
                    </tr>
                    <tr>
                        <td>3.增強您了解拒絕毒品技巧及能力，感到?</td>
                        <td>
                            <input class="form-control" type="number" name="q_3_1" required value="{{ $educator_propaganda->q_3_1 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_3_2" required value="{{ $educator_propaganda->q_3_2 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_3_3" required value="{{ $educator_propaganda->q_3_3 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_3_4" required value="{{ $educator_propaganda->q_3_4 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_3_5" required value="{{ $educator_propaganda->q_3_5 }}">
                        </td>
                    </tr>
                    <tr>
                        <td>4.增進您對提升新興毒品與藥物濫用辨識能力，感到?</td>
                        <td>
                            <input class="form-control" type="number" name="q_4_1" required value="{{ $educator_propaganda->q_4_1 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_4_2" required value="{{ $educator_propaganda->q_4_2 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_4_3" required value="{{ $educator_propaganda->q_4_3 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_4_4" required value="{{ $educator_propaganda->q_4_4 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_4_5" required value="{{ $educator_propaganda->q_4_5 }}">
                        </td>
                    </tr>
                    <tr>
                        <td>5.增進了解若周遭朋友(家人、同學)使用毒品，如何協助尋求幫助，感到?</td>
                        <td>
                            <input class="form-control" type="number" name="q_5_1" required value="{{ $educator_propaganda->q_5_1 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_5_2" required value="{{ $educator_propaganda->q_5_2 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_5_3" required value="{{ $educator_propaganda->q_5_3 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_5_4" required value="{{ $educator_propaganda->q_5_4 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_5_5" required value="{{ $educator_propaganda->q_5_5 }}">
                        </td>
                    </tr>
                    <tr>
                        <td>6.對講師宣講內容及上課方式，感到?</td>
                        <td>
                            <input class="form-control" type="number" name="q_6_1" required value="{{ $educator_propaganda->q_6_1 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_6_2" required value="{{ $educator_propaganda->q_6_2 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_6_3" required value="{{ $educator_propaganda->q_6_3 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_6_4" required value="{{ $educator_propaganda->q_6_4 }}">
                        </td>
                        <td>
                            <input class="form-control" type="number" name="q_6_5" required value="{{ $educator_propaganda->q_6_5 }}">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
                <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-forward"></i> 儲存「教育人員宣導」</button>
                <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
@endsection
