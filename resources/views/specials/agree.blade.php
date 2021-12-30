@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('specials.index') }}">「特定人員名冊」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯特定人員名冊</li>
        </ol>
    </nav>
    <a href="#" onclick="history.back()" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/special.png') }}" height="40">
                特定人員名冊
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
            <div class="form-group">
                <label for="date">填報日期
                </label><br>
                {{ $special->date }}
            </div>
            {{ Form::open(['route' => 'specials.store_member', 'method' => 'post','files' => true]) }}
            <div class="form-group">
                <label for="class">班級<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="class" id="class" required>
            </div>
            <div class="form-group">
                <label for="number">學號<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="number" id="number" required>
            </div>
            <div class="form-group">
                <label for="name">姓名<strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label>性別<strong class="text-danger">*</strong>
                </label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sex" id="sex1" value="男" checked>
                    <label class="form-check-label" for="sex1">男</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sex" id="sex2" value="女">
                    <label class="form-check-label" for="sex2">女</label>
                </div>
            </div>
            <div class="form-group">
                <label for="type">特定人員類別<strong class="text-danger">*</strong>
                <small class="text-secondary">(類別4：需上傳其父母或監護人同意書)</small>
                </label><br>
                {{ Form::select('special_type',$special_types,null,['id'=>'special_type','class' => 'form-control','required'=>'required','onchange'=>'show_agree()']) }}
                <br><br>
            </div>
            <div id="upload" style="display:none;">
                <div class="form-group">
                    <label for="file">
                        同意書
                        <small class="text-danger">(上述選擇類別4：需上傳其父母或監護人同意書)</small>
                    </label>
                    {{ Form::file('file', ['class' => 'form-control','id'=>'file']) }}
                </div>
            </div>
            <div class="form-group">
                <label for="note">備註</label>
                <input type="text" class="form-control" name="note" id="note">
            </div>
            <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-plus-circle"></i> 單筆增加</button>
            <input type="hidden" name="special_id" value="{{ $special->id }}">
            <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            <hr>
            <a name="list"></a>
            <h4>特定人員列表</h4>
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th nowrap>
                        班級
                    </th>
                    <th nowrap>
                        學號
                    </th>
                    <th nowrap>
                        姓名
                    </th>
                    <th nowrap>
                        性別
                    </th>
                    <th nowrap>
                        類別
                    </th>
                    <th nowrap>
                        備註
                    </th>
                    <th nowrap>
                        動作
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($special_members as $special_member)
                    <tr>
                        <td>
                            {{ $special_member->class }}
                        </td>
                        <td>
                            {{ $special_member->number }}
                        </td>
                        <td>
                            {{ $special_member->name }}
                        </td>
                        <td>
                            {{ $special_member->sex }}
                        </td>
                        <td>
                            {{ $special_types[$special_member->special_type] }}
                            @if($special_member->special_type == 4 and !empty($special_member->filename))
                                同意書<a href="{{ route('specials.open',[$special_member,'member_agree']) }}" target="_blank"><i class="fas fa-download text-primary"></i></a>
                            @endif
                        </td>
                        <td>
                            {{ $special_member->note }}
                        </td>
                        <td>
                            <a href="{{ route('specials.delete_member',$special_member->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除此筆</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function show_agree(){
            if($('#special_type').val()==4){
                $('#upload').show();
                $('#file').prop('required',true);
            }else{
                $('#upload').hide();
                $('#file').prop('required',false);
            }
        }
    </script>
@endsection
