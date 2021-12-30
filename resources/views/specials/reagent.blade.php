@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('specials.index') }}">「特定人員名冊」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">編輯「快速檢驗試劑名冊」</li>
        </ol>
    </nav>
    <a href="#" onclick="history.back()" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/special.png') }}" height="40">
                快速檢驗試劑名冊
            </h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label class="font-weight-bold">機關/單位/名稱</label><br>
                @if(!empty(auth()->user()->school_code))
                    {{ $schools[auth()->user()->school_code] }}
                @else
                    {{ auth()->user()->name }}
                @endif
            </div>
            <div class="form-group">
                <label for="date" class="font-weight-bold">填報日期
                </label><br>
                {{ $special->date }}
            </div>
            {{ Form::open(['route' => 'specials.store_reagent', 'method' => 'post']) }}
            <div class="form-group">
                <label for="name" class="font-weight-bold">篩檢名單<strong class="text-danger">*</strong>
                </label><br>
                {{ Form::select('name',$name_list,null,['id'=>'name','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">性別<strong class="text-danger">*</strong>
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
                <label class="font-weight-bold">學制<strong class="text-danger">*</strong>
                </label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="depart" id="depart1" value="日間" checked>
                    <label class="form-check-label" for="depart1">日間</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="depart" id="depart2" value="進修">
                    <label class="form-check-label" for="depart2">進修</label>
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="font-weight-bold">篩檢日期<strong class="text-danger">*</strong>
                </label>
                <input type="date" class="form-control" name="date" id="date" required maxlength="10" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="reagent_brand" class="font-weight-bold">試劑廠牌<strong class="text-danger">*</strong></label><br>
                {{ Form::select('reagent_brand',$reagent_brands,null,['id'=>'reagent_brand','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label for="reagent_type" class="font-weight-bold">試劑種類<strong class="text-danger">*</strong></label><br>
                {{ Form::select('reagent_type',$reagent_types,null,['id'=>'reagent_type','class' => 'form-control','required'=>'required']) }}
                <br><br>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">篩驗結果<strong class="text-danger">*</strong>
                </label><br>
                <div class="form-check form-check-inline" onclick="hide_note()">
                    <input class="form-check-input" type="radio" name="result" id="result1" value="陽性" checked>
                    <label class="form-check-label" for="result1">陽性</label>
                </div>
                <div class="form-check form-check-inline" onclick="hide_note()">
                    <input class="form-check-input" type="radio" name="result" id="result2" value="陰性">
                    <label class="form-check-label" for="result2">陰性</label>
                </div>
                <div class="form-check form-check-inline" onclick="show_note()">
                    <input class="form-check-input" type="radio" name="result" id="result3" value="其他">
                    <label class="form-check-label" for="result3">其他 (選擇此項時，原因請填寫在下面的「備考」欄位中)</label>
                </div>
            </div>
            <div class="form-group">
                <label for="note" class="font-weight-bold">備考</label>
                <input type="text" class="form-control" name="note" id="note">
            </div>
            <button type="submit" class="btn btn-outline-success" onclick="return confirm('確定送出嗎？')"><i class="fas fa-plus-circle"></i> 單筆增加</button>
            <input type="hidden" name="special_id" value="{{ $special->id }}">
            <input type="hidden" name="school_code" value="{{ auth()->user()->school_code }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
            <hr>
            <a name="list"></a>
            <h4>快速檢驗試劑名冊列表</h4>
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th nowrap>
                        篩檢名單
                    </th>
                    <th nowrap>
                        性別
                    </th>
                    <th nowrap>
                        學制
                    </th>
                    <th nowrap>
                        篩檢日期
                    </th>
                    <th>
                        使用篩劑類型
                    </th>
                    <th>
                        篩驗結果
                    </th>
                    <th>
                        備考
                    </th>
                    <th>
                        動作
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($special_reagents as $special_reagent)
                    <tr>
                        <td>
                            {{ $special_reagent->name }}
                        </td>
                        <td>
                            {{ $special_reagent->sex }}
                        </td>
                        <td>
                            {{ $special_reagent->depart }}
                        </td>
                        <td>
                            {{ $special_reagent->date }}
                        </td>
                        <td>
                            {{ $reagent_brands[$special_reagent->reagent_brand] }}/{{ $reagent_types[$special_reagent->reagent_type] }}
                        </td>
                        <td>
                            {{ $special_reagent->result }}
                        </td>
                        <td>
                            {{ $special_reagent->note }}
                        </td>
                        <td>
                            <a href="{{ route('specials.delete_reagent',$special_reagent->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function show_note(){
            $('#note').prop('required',true);
        }
        function hide_note(){
            $('#note').prop('required',false);
        }
    </script>
@endsection
