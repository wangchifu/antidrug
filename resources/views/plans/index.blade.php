@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/plan.png') }}" height="40">
                防制學生藥物濫用實施計畫(年度計畫)
            </h5>
        </div>
        <div class="card-body">
            {{ Form::open(['route' => 'plans.store', 'method' => 'post', 'files' => true]) }}
                <div class="form-group">
                    <label for="year">計畫年度<strong class="text-danger">*</strong></label>
                    <input type="text" class="form-control" name="year" id="year" required maxlength="3" placeholder="3碼學年度">
                </div>
                <div class="form-group">
                    <label for="file">
                        附件<strong class="text-danger">*</strong>(檔案不可超過5MB)
                    </label>
                    {{ Form::file('file', ['class' => 'form-control','required'=>'required']) }}
                </div>
                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('確定嗎？同年度會覆蓋喔！')"><i class="fas fa-plus-circle"></i> 送出</button>
                <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="status" value="0">
            {{ Form::close() }}
            @include('layouts.form_errors')
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th nowrap>年度</th>
            <th nowrap>單位</th>
            <th nowrap>狀態</th>
            <th nowrap>檔案</th>
            <th nowrap>審核說明</th>
            <th nowrap>動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($plans as $plan)
            <tr>
                <td>{{ $plan->year }}</td>
                <td>
                    @if(!empty($plan->user->school_code))
                        {{ $schools[$plan->user->school_code] }}
                    @else
                        {{ $plan->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $plan->created_at }}</small>
                </td>
                <?php
                    $color = "";
                    if($plan->status==0) $color = "text-secondary";
                    if($plan->status==1) $color = "text-primary";
                    if($plan->status==2) $color = "text-danger";
                    if($plan->status==3) $color = "text-warning";
                    if($plan->status==4) $color = "text-success";
                ?>
                <td class="{{ $color }}">
                    {{ $status[$plan->status] }}                    
                </td>
                <td>
                    <?php
                        $d = (empty($plan->user->school_code))?$plan->user->username:$plan->user->school_code;
                        $files = get_files(storage_path('app/public/plans/'.$plan->year.'/'.$d));
                    ?>
                    @foreach($files as $file)
                        <a href="{{ asset('storage/plans/'.$plan->year.'/'.$d.'/'.$file) }}" target="_blank">
                            <span class="btn btn-outline-primary btn-sm"><i class="fas fa-download"></i> 檔案</span>
                        </a>
                    @endforeach
                    @if(empty($files))
                        檔案遺失
                    @endif
                </td>
                <td>
                    {{ $plan->review_desc }}<small class="text-secondary">{{ $plan->review_at }}</small>
                </td>
                <td>
                    @if($plan->status == 0)
                        @if($plan->user_id == auth()->user()->id)
                            <a href="{{ route('plans.submit',$plan->id) }}" class="btn btn-warning btn-sm" onclick="return confirm('確定送出不更改？')"> 送出</a>
                            <a href="{{ route('plans.destroy',$plan->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')"><i class="fas fa-times-circle"></i> 刪除</a>
                        @else
                            <small class="text-secondary">{{ $plan->user->name }}</small>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
