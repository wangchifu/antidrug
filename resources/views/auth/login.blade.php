@extends('layouts.master')

@section('content')
    <form id="login_form" method="POST" action="{{ route('gauth') }}" onsubmit="check_select();return false;">
    @csrf

    <?php
    $select1 = "";
    $select2 = "";
    if($errors->any()){
        $error = $errors->all();
        if(isset($error[1])){
            if($error[1] == "gsuite"){
                $select1 = "selected";
            }
            if($error[1] == "local"){
                $select2 = "selected";
            }
        }
    }

    ?>

    <div class="card">
        <div class="card-header">
            <select class="form-select" aria-label="Default select example" name="type" required="required" id="type_select" onchange="show_form()">
                <option value="0">--請先選擇登入帳號類型--</option>
                <option value="gsuite" class="form-control" {{ $select1 }}>國中小 GSuite 登入</option>
                <option value="local" class="form-control" {{ $select2 }}>本機登入(其他單位或管理)</option>
            </select>
        </div>
        <div class="card-body">
            <div id="input_form">
                @if($select1)
                    <a href="https://gsuite.chc.edu.tw" target="_blank"><img src="images/gsuite_logo.png"></a>
                    <div class="form-group row">
                        <label for="gsuite_username" class="col-md-4 col-form-label text-md-right">帳號</label>
                        <div class="input-group col-md-6">
                            <input tabindex="1" id="gsuite_username" type="text" class="form-control" name="username" required aria-label="Recipients username" aria-describedby="basic-addon2" placeholder="教育處 GSuite 帳號"  autofocus>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">@chc.edu.tw</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">密碼</label>
                        <div class="col-md-6">
                            <input tabindex="2" id="password" type="password" class="form-control" name="password" required placeholder="密碼">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 text-md-left">
                        </div>
                        <div class="col-md-6 text-md-left">
                            <img src="pic" class="img-fluid" id="captcha_img"> <div class="badge badge-secondary"><i class="fas fa-recycle" onclick="change_img()"></i></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="chaptcha" class="col-md-4 col-form-label text-md-right">驗證碼</label>

                        <div class="col-md-6">
                            <input tabindex="3" id="password" type="text" class="form-control" name="chaptcha" required placeholder="上圖數字" maxlength="5">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button tabindex="3" type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> 登入
                            </button>
                        </div>
                    </div>
                @endif
                @if($select2)
                    <div class="form-group row">
                        <label for="gsuite_username" class="col-md-4 col-form-label text-md-right">帳號</label>
                        <div class="input-group col-md-6">
                            <input tabindex="1" id="gsuite_username" type="text" class="form-control" name="username" required aria-label="Recipients username" aria-describedby="basic-addon2" placeholder="本機帳號" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">密碼</label>
                        <div class="col-md-6">
                            <input tabindex="2" id="password" type="password" class="form-control" name="password" required placeholder="密碼">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 text-md-left">
                        </div>
                        <div class="col-md-6 text-md-left">
                            <img src="pic" class="img-fluid" id="captcha_img"> <div class="badge badge-secondary"><i class="fas fa-recycle" onclick="change_img()"></i></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="chaptcha" class="col-md-4 col-form-label text-md-right">驗證碼</label>

                        <div class="col-md-6">
                            <input tabindex="3" id="password" type="text" class="form-control" name="chaptcha" required placeholder="上圖數字" maxlength="5">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button tabindex="3" type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> 登入
                            </button>
                        </div>
                    </div>
                @endif
            </div>
            @include('layouts.form_errors')
        </div>
    </div>
    </form>
    <script>
        function change_img(){
            var d = new Date();
            $('#captcha_img').attr('src',  'pic?' + d.getTime());
        }
        function check_select(){
            if($('#type_select').val()==0){
                alert('請選擇登入帳號類型');
            }else{
                $('#login_form').submit();
            }
        }
        function show_form(){
            all = '';
            if($('#type_select').val()=="0"){

            }else{
                if($('#type_select').val()=="gsuite"){
                    all = all+'<a href="https://gsuite.chc.edu.tw" target="_blank"><img src="images/gsuite_logo.png"></a>';
                    all = all+'<div class="form-group row">';
                    all = all+'<label for="gsuite_username" class="col-md-4 col-form-label text-md-right">帳號</label>';
                    all = all+'<div class="input-group col-md-6">';
                    all = all+'<input tabindex="1" id="gsuite_username" type="text" class="form-control" name="username" required aria-label="Recipients username" aria-describedby="basic-addon2" placeholder="教育處 GSuite 帳號">';
                    all = all+'<div class="input-group-append">';
                    all = all+'<span class="input-group-text" id="basic-addon2">@chc.edu.tw</span>';
                    all = all+'</div>';
                    all = all+'</div>';
                    all = all+'</div>';
                }else if($('#type_select').val()=="local"){
                    all = all+'<div class="form-group row">';
                    all = all+'<label for="local_username" class="col-md-4 col-form-label text-md-right">帳號</label>';
                    all = all+'<div class="input-group col-md-6">';
                    all = all+'<input tabindex="1" id="local_username" type="text" class="form-control" name="username" required aria-label="Recipients username" aria-describedby="basic-addon2" placeholder="本機帳號">';
                    all = all+'</div>';
                    all = all+'</div>';
                }
                all = all+'<div class="form-group row">';
                all = all+'<label for="password" class="col-md-4 col-form-label text-md-right">密碼</label>';
                all = all+'<div class="col-md-6">';
                all = all+'<input tabindex="2" id="password" type="password" class="form-control" name="password" required placeholder="密碼">';
                all = all+'</div>';
                all = all+'</div>';
                all = all+'<div class="form-group row">';
                all = all+'<div class="col-md-4 text-md-left">';
                all = all+'</div>';
                all = all+'<div class="col-md-6 text-md-left">';
                all = all+'<img src="pic" class="img-fluid" id="captcha_img">';
                all = all+' <div class="badge badge-secondary"><i class="fas fa-recycle" onclick="change_img()"></i></div>';
                all = all+'</div>';
                all = all+'</div>';
                all = all+'<div class="form-group row">';
                all = all+'<label for="chaptcha" class="col-md-4 col-form-label text-md-right">驗證碼</label>';
                all = all+'<div class="col-md-6">';
                all = all+'<input tabindex="3" id="password" type="text" class="form-control" name="chaptcha" required placeholder="上圖數字" maxlength="5">';
                all = all+'</div>';
                all = all+'</div>';
                all = all+'<div class="form-group row mb-0">';
                all = all+'<div class="col-md-8 offset-md-4">';
                all = all+'<button tabindex="3" type="submit" class="btn btn-primary">';
                all = all+'<i class="fas fa-sign-in-alt"></i> 登入';
                all = all+'</button>';
                all = all+'</div>';
                all = all+'</div>';
            }
            document.getElementById('input_form').innerHTML= all;
            if($('#type_select').val()=="gsuite"){
                setTimeout(function() { $('#gsuite_username').focus() }, 20);
            }else if($('#type_select').val()=="local"){
                setTimeout(function() { $('#local_username').focus() }, 20);
            }
        }
    </script>
@endsection
