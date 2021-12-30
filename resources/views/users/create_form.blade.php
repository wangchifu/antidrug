    @csrf
    <div class="form-group">
        <label for="admin">帳號類別 <strong class="text-danger">*</strong></label><br>
        <select class="form-control" name="admin" onchange="show_user()" id="admin" required>
            <option value="0" class="form-control">非管理者</option>
            <option value="1" class="form-control">系統管理者</option>
        </select>
    </div><br><br>
    <div class="form-group">
        <label for="username">登入帳號 <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">密碼 <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="password" name="password" value="{{ env('DEFAULT_PWD') }}" readonly>
    </div>
    <div class="form-group">
        <label for="name">名稱姓名 <strong class="text-danger">*</strong></label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div id="general_user">
        <div class="form-group">
            <label for="class">帳號類別 <strong class="text-danger">*</strong></label><br>
            <select class="form-control" name="class" onchange="show_area()" id="class" required>
                <option value="0">無</option>
                <option value="1" class="form-control">國小</option>
                <option value="2" class="form-control">國中</option>
                <option value="3" class="form-control">高中職</option>
                <option value="4" class="form-control">政府機關</option>
                <option value="5" class="form-control">民間機構</option>
            </select>
        </div><br><br>
        <div id="show_area" style="display:none;">
            <div class="form-group">
                <label for="class">行政區(國小要選) <strong class="text-danger">*</strong></label><br>
                <select name="area" class="form-group">
                    <option value="1" class="form-group">彰化區</option>
                    <option value="2" class="form-group">和美區</option>
                    <option value="3" class="form-group">鹿港區</option>
                    <option value="4" class="form-group">溪湖區</option>
                    <option value="5" class="form-group">員林區</option>
                    <option value="6" class="form-group">田中區</option>
                    <option value="7" class="form-group">北斗區</option>
                    <option value="8" class="form-group">二林區</option>
                    <option value="9" class="form-group">其他學校</option>
                </select>
            </div><br><br>
        </div>
        <hr>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="special" id="special1" value="1" checked>
            <label class="form-check-label" for="special1">
                是，可於每月反毒宣導績效表填報使用批次匯入功能
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="special" id="special2" value="0">
            <label class="form-check-label" for="special2">
                否，不可於每月反毒宣導績效表填報使用批次匯入功能
            </label>
        </div>
        <hr>
        選單顯示
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="menu[]">
            <label class="form-check-label" for="defaultCheck1">
                反毒中心學校、教育處自辦活動
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="2" id="defaultCheck2" name="menu[]">
            <label class="form-check-label" for="defaultCheck2">
                學校相關：各校毒品防制宣導活動成果、班親會等向家長反毒宣導、戒毒成功專線
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="3" id="defaultCheck3" name="menu[]">
            <label class="form-check-label" for="defaultCheck3">
                特定人員名冊填報、尿篩帳籍管制紀錄簿
            </label>
        </div>
        <strong>
            以上項目未核取時，僅顯示「紫防制學生藥物濫用實施計畫傳、每月反毒宣導績效表填報、相關教學…等選單」
        </strong>
        <hr>
    </div>
    <div id="admin_user" style="display:none;">
        <hr>
        系統權限 <strong class="text-danger">*</strong>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="A01" id="admin_level1" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level1">
                最新消息管理(A01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="B01" id="admin_level2" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level2">
                首頁廣告輪播管理(B01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="C01" id="admin_level3" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level3">
                防制學生藥物濫用實施計畫管理(C01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="D01" id="admin_level4" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level4">
                每月反毒宣導績效表管理(D01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="E01" id="admin_level5" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level5">
                各校毒品防制宣導(教育人員)管理(E01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="F01" id="admin_level6" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level6">
                各校毒品防制宣導(學生)管理(F01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="G01" id="admin_level7" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level7">
                反毒中心學校成果管理(G01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="I01" id="admin_level8" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level8">
                教育處自辦活動成果管理(I01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="J01" id="admin_level9" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level9">
                班親會…等向家長反毒宣導管理(J01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Q01" id="admin_level10" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level10">
                學校辦理戒毒成功專線宣導管理(Q01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="R01" id="admin_level11" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level11">
                特定人員名冊管理(R01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="S01" id="admin_level12" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level12">
                自訂線上調查管理(S01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="H01" id="admin_level13" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level13">
                網站連結管理、網站範本檔案管理(H01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="K01" id="admin_level14" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level14">
                網站資訊管理(K01)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="O01" id="admin_level15" name="admin_level[]" checked>
            <label class="form-check-label" for="admin_level15">
                學校、機關網站帳號管理、後台網站帳號管理(O01)
            </label>
        </div>
        <hr>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
    </div>

    <hr>
    <div class="form-group">
        <label for="note">備註</label>
        <input type="text" class="form-control" id="note" name="note">
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
        function show_user(){
            if($('#admin').val()==1){
                $('#admin_user').show();
                $('#general_user').hide();
            }else if($('#admin').val()==0){
                $('#admin_user').hide();
                $('#general_user').show();
            }
        }
    </script>
