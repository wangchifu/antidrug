    @csrf
    <div class="form-group">
        <label for="username">登入帳號 <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" readonly>
    </div>
    <div class="form-group">
        <label for="name">名稱姓名 <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="name" name="name" required value="{{ $user->name }}">
    </div>
    <div class="form-group">
        <?php
        $select0=($user->class==0)?"selected":"";
        $select1=($user->class==1)?"selected":"";
        $select2=($user->class==2)?"selected":"";
        $select3=($user->class==3)?"selected":"";
        $select4=($user->class==4)?"selected":"";
        $select5=($user->class==5)?"selected":"";
        ?>
        <label for="class">帳號類別 <strong class="text-danger">*</strong></label><br>
        <select class="form-control" name="class" onchange="show_area()" id="class" required>
            <option value="0" {{ $select0 }} class="form-control">無</option>
            <option value="1" {{ $select1 }} class="form-control">國小</option>
            <option value="2" {{ $select2 }} class="form-control">國中</option>
            <option value="3" {{ $select3 }} class="form-control">高中職</option>
            <option value="4" {{ $select4 }} class="form-control">政府機關</option>
            <option value="5" {{ $select5 }} class="form-control">民間機構</option>
        </select>
    </div><br><br>
    <?php
    if($user->class==1){
        $style = "";
    }else{
        $style = "display:none;";
    }
    $select_area1=($user->area==1)?"selected":"";
    $select_area2=($user->area==2)?"selected":"";
    $select_area3=($user->area==3)?"selected":"";
    $select_area4=($user->area==4)?"selected":"";
    $select_area5=($user->area==5)?"selected":"";
    $select_area6=($user->area==6)?"selected":"";
    $select_area7=($user->area==7)?"selected":"";
    $select_area8=($user->area==8)?"selected":"";
    $select_area9=($user->area==9)?"selected":"";
    ?>
    <div id="show_area" style="{{ $style }}">
        <div class="form-group">
            <label for="class">行政區(國小要選) <strong class="text-danger">*</strong></label><br>
            <select name="area" class="form-group">
                <option value="1" class="form-group" {{ $select_area1 }}>彰化區</option>
                <option value="2" class="form-group" {{ $select_area2 }}>和美區</option>
                <option value="3" class="form-group" {{ $select_area3 }}>鹿港區</option>
                <option value="4" class="form-group" {{ $select_area4 }}>溪湖區</option>
                <option value="5" class="form-group" {{ $select_area5 }}>員林區</option>
                <option value="6" class="form-group" {{ $select_area6 }}>田中區</option>
                <option value="7" class="form-group" {{ $select_area7 }}>北斗區</option>
                <option value="8" class="form-group" {{ $select_area8 }}>二林區</option>
                <option value="9" class="form-group" {{ $select_area9 }}>其他學校</option>
            </select>
        </div><br><br>
    </div>
    <hr>
    <?php
        $check_special1 = ($user->special==1)?"checked":"";
        $check_special2 = ($user->special==0)?"checked":"";
    ?>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="special" id="special1" value="1" {{ $check_special1 }}>
        <label class="form-check-label" for="special1">
            是，可於每月反毒宣導績效表填報使用批次匯入功能
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="special" id="special2" value="0"  {{ $check_special2 }}>
        <label class="form-check-label" for="special2">
            否，不可於每月反毒宣導績效表填報使用批次匯入功能
        </label>
    </div>
    <hr>
    <?php
        $menu = $user->menu;
        $check_menu1 = "";
        $check_menu2 = "";
        $check_menu3 = "";
        if(strpos($menu,'1') !== false) $check_menu1 = "checked";
        if(strpos($menu,'2') !== false) $check_menu2 = "checked";
        if(strpos($menu,'3') !== false) $check_menu3 = "checked";
    ?>
    選單顯示
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="menu[]" {{ $check_menu1 }}>
        <label class="form-check-label" for="defaultCheck1">
            反毒中心學校、教育處自辦活動
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="2" id="defaultCheck2" name="menu[]" {{ $check_menu2 }}>
        <label class="form-check-label" for="defaultCheck2">
            學校相關：各校毒品防制宣導活動成果、班親會等向家長反毒宣導、戒毒成功專線
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="3" id="defaultCheck3" name="menu[]" {{ $check_menu3 }}>
        <label class="form-check-label" for="defaultCheck3">
            特定人員名冊填報、尿篩帳籍管制紀錄簿
        </label>
    </div>
    <strong>
        以上項目未核取時，僅顯示「紫防制學生藥物濫用實施計畫傳、每月反毒宣導績效表填報、相關教學…等選單」
    </strong>
    <hr>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="{{ $user->email }}">
    </div>

    <hr>
    <div class="form-group">
        <label for="note">備註</label>
        <input type="text" class="form-control" id="note" name="note" value="{{ $user->note }}">
    </div>
    <input type="hidden" name="type" value="local">
    <button type="submit" class="btn btn-primary" onclick="return confirm('確定嗎？')">送出</button>
    <script>
        function show_area(){
            if($('#class').val()==1){
                $('#show_area').show();
            }else{
                $('#show_area').hide();
            }
        }
    </script>
