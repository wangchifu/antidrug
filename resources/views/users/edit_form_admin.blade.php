    @csrf
    <div class="form-group">
        <label for="username">登入帳號 <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" readonly>
    </div>
    <div class="form-group">
        <label for="name">名稱姓名 <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="name" name="name" required value="{{ $user->name }}">
    </div>
    <hr>
    系統權限 <strong class="text-danger">*</strong>
    <?php
        $admin_level = $user->admin_level;
        $check_A01 = "";
        $check_B01 = "";
        $check_C01 = "";
        $check_D01 = "";
        $check_E01 = "";
        $check_F01 = "";
        $check_G01 = "";
        $check_I01 = "";
        $check_J01 = "";
        $check_Q01 = "";
        $check_R01 = "";
        $check_S01 = "";
        $check_H01 = "";
        $check_K01 = "";
        $check_O01 = "";
        if(strpos($admin_level,'A01') !== false) $check_A01 = "checked";
        if(strpos($admin_level,'B01') !== false) $check_B01 = "checked";
        if(strpos($admin_level,'C01') !== false) $check_C01 = "checked";
        if(strpos($admin_level,'D01') !== false) $check_D01 = "checked";
        if(strpos($admin_level,'E01') !== false) $check_E01 = "checked";
        if(strpos($admin_level,'F01') !== false) $check_F01 = "checked";
        if(strpos($admin_level,'G01') !== false) $check_G01 = "checked";
        if(strpos($admin_level,'I01') !== false) $check_I01 = "checked";
        if(strpos($admin_level,'J01') !== false) $check_J01 = "checked";
        if(strpos($admin_level,'Q01') !== false) $check_Q01 = "checked";
        if(strpos($admin_level,'R01') !== false) $check_R01 = "checked";
        if(strpos($admin_level,'S01') !== false) $check_S01 = "checked";
        if(strpos($admin_level,'H01') !== false) $check_H01 = "checked";
        if(strpos($admin_level,'K01') !== false) $check_K01 = "checked";
        if(strpos($admin_level,'O01') !== false) $check_O01 = "checked";
    ?>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="A01" id="admin_level1" name="admin_level[]" {{ $check_A01 }}>
        <label class="form-check-label" for="admin_level1">
            最新消息管理(A01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="B01" id="admin_level2" name="admin_level[]" {{ $check_B01 }}>
        <label class="form-check-label" for="admin_level2">
            首頁廣告輪播管理(B01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="C01" id="admin_level3" name="admin_level[]" {{ $check_C01 }}>
        <label class="form-check-label" for="admin_level3">
            防制學生藥物濫用實施計畫管理(C01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="D01" id="admin_level4" name="admin_level[]" {{ $check_D01 }}>
        <label class="form-check-label" for="admin_level4">
            每月反毒宣導績效表管理(D01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="E01" id="admin_level5" name="admin_level[]" {{ $check_E01 }}>
        <label class="form-check-label" for="admin_level5">
            各校毒品防制宣導(教育人員)管理(E01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="F01" id="admin_level6" name="admin_level[]" {{ $check_F01 }}>
        <label class="form-check-label" for="admin_level6">
            各校毒品防制宣導(學生)管理(F01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="G01" id="admin_level7" name="admin_level[]" {{$check_G01 }}>
        <label class="form-check-label" for="admin_level7">
            反毒中心學校成果管理(G01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="I01" id="admin_level8" name="admin_level[]" {{ $check_I01 }}>
        <label class="form-check-label" for="admin_level8">
            教育處自辦活動成果管理(I01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="J01" id="admin_level9" name="admin_level[]" {{ $check_J01 }}>
        <label class="form-check-label" for="admin_level9">
            班親會…等向家長反毒宣導管理(J01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="Q01" id="admin_level10" name="admin_level[]" {{ $check_Q01 }}>
        <label class="form-check-label" for="admin_level10">
            學校辦理戒毒成功專線宣導管理(Q01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="R01" id="admin_level11" name="admin_level[]" {{ $check_R01 }}>
        <label class="form-check-label" for="admin_level11">
            特定人員名冊管理(R01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="S01" id="admin_level12" name="admin_level[]" {{ $check_S01 }}>
        <label class="form-check-label" for="admin_level12">
            自訂線上調查管理(S01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="H01" id="admin_level13" name="admin_level[]" {{ $check_H01 }}>
        <label class="form-check-label" for="admin_level13">
            網站連結管理、網站範本檔案管理(H01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="K01" id="admin_level14" name="admin_level[]" {{ $check_K01 }}>
        <label class="form-check-label" for="admin_level14">
            網站資訊管理(K01)
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="O01" id="admin_level15" name="admin_level[]" {{ $check_O01 }}>
        <label class="form-check-label" for="admin_level15">
            學校、機關網站帳號管理、後台網站帳號管理(O01)
        </label>
    </div>
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
    <button type="submit" class="btn btn-primary" onclick="return confirm('確定嗎？')">送出</button>
