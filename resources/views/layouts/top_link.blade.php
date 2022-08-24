<?php
    $active = $_SERVER['REQUEST_URI'];
    $active1 = "";
    $active_users = "";
    $active_upload1 = "";
    $active_upload2 = "";
    $active_upload3 = "";
    $result1 = "";
    $active_web = "";
    $active_review1 = "";
    $active_review2 = "";
    $active_review3 = "";
    $active_download = "";
    if($active == "/") $active1 = "active";
    if(strpos($active,"/users") !== false) $active_users = "active";
    if(strpos($active,"/upload1") !== false) $active_upload1 = "active";
    if(strpos($active,"/upload2") !== false) $active_upload2 = "active";
    if(strpos($active,"/upload3") !== false) $active_upload3 = "active";
    if(strpos($active,"/result") !== false) $result1 = "active";
    if(strpos($active,"/web") !== false) $active_web = "active";
    if(strpos($active,"/review1") !== false) $active_review1 = "active";
    if(strpos($active,"/review2") !== false) $active_review2 = "active";
    if(strpos($active,"/review3") !== false) $active_review3 = "active";
    if(strpos($active,"/download") !== false) $active_download = "active";
?>
<ul>
    <li class="{{ $active1 }}"><a href="{{ route('index') }}">首頁</a></li>
    @auth
        <li class="{{ $active_users }}"><a href="#">帳號管理</a>
            <ul class="header__menu__dropdown">
                <li><a href="{{ route('reset_pwd') }}">1>更改密碼</a></li>
                @if(auth()->user()->admin==1)
                    <li><a href="{{ route('users.index') }}">2>全站帳號管理</a></li>
                @endif
                @impersonating
                <li><a href="{{ route('sims.impersonate_leave') }}" onclick="return confirm('確定返回原本帳琥？')">結束模擬</a></li>
                @endImpersonating
            </ul>
        </li>
        @if(auth()->user()->admin==1)
            <li class="{{ $active_web }}"><a href="#">網站管理</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('posts.index') }}">1> 公告系統</a></li>
                    <li><a href="{{ route('title_images.index') }}">2> 標題圖片</a></li>
                    <li><a href="{{ route('links.index') }}">3> 選單連結</a></li>
                    <li><a href="{{ route('articles.index') }}">4> 文章內容</a></li>
                    <li><a href="{{ route('uploads.index') }}">5> 檔案掛載</a></li>
                    <li><a href="{{ route('setups.index') }}">6> 網站資訊</a></li>
                </ul>
            </li>
            <li class="{{ $active_review1 }}"><a href="#">一般上傳管理</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('plans.review') }}">1> 年度計畫</a></li>
                    <!--
                    <li><a href="{{ route('monthly_propagandas.review') }}">2> 每月反毒</a></li>
                    -->
                    <li><a href="{{ route('educator_propagandas.review') }}">2> 毒品防制宣導(教育人員)</a></li>
                    <li><a href="{{ route('student_propagandas.review') }}">3> 毒品防制宣導(學生)</a></li>
                    <li><a href="{{ route('parent_propagandas.review') }}">4> 毒品防制宣導(家長)</a></li>
                    <li><a href="{{ route('telephone_propagandas.review') }}">5> 戒毒成功專線宣導</a></li>
                    <li><a href="{{ route('tzuchi_propagandas.review') }}">6> 慈濟無毒有我宣導</a></li>
                </ul>
            </li>
            <li class="{{ $active_review2 }}"><a href="#">中心上傳管理</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('boe_actives.review') }}">1> 教育處自辦活動</a></li>
                    <!--
                    <li><a href="{{ route('center_actives.review') }}">2> 反毒中心學校成果</a></li>
                    -->
                </ul>
            </li>
            <!--
            <li class="{{ $active_review3 }}"><a href="#">特定上傳管理</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('specials.review') }}">1> 特定人員名冊</a></li>
                    <li><a href="{{ route('urine_screen_books.review') }}">2> 尿篩帳籍管制紀錄簿</a></li>
                    <li><a href="{{ route('urine_screen_works.review') }}">3> 執行擴大尿篩工作</a></li>
                </ul>
            </li>
            -->
        @else
            <li class="{{ $active_upload1 }}"><a href="#">一般上傳</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('plans.index') }}">1> 年度計畫</a></li>
                    <!--
                    <li><a href="{{ route('monthly_propagandas.index') }}">2> 每月反毒</a></li>
                    -->
                    <li><a href="{{ route('educator_propagandas.index') }}">2> 毒品防制宣導(教育人員)</a></li>
                    <li><a href="{{ route('student_propagandas.index') }}">3> 毒品防制宣導(學生)</a></li>
                    <li><a href="{{ route('parent_propagandas.index') }}">4> 毒品防制宣導(家長)</a></li>
                    <li><a href="{{ route('telephone_propagandas.index') }}">5> 戒毒成功專線宣導</a></li>
                    <li><a href="{{ route('tzuchi_propagandas.index') }}">6> 慈濟無毒有我宣導</a></li>
                </ul>
            </li>
            <li class="{{ $active_upload2 }}"><a href="#">中心上傳</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('boe_actives.index') }}">1> 教育處自辦活動</a></li>
                    <!--
                    <li><a href="{{ route('center_actives.index') }}">2> 反毒中心學校成果</a></li>
                    -->
                </ul>
            </li>
            <!--
            <li class="{{ $active_upload3 }}"><a href="#">特定上傳</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('specials.index') }}">1> 特定人員名冊</a></li>
                    <li><a href="{{ route('urine_screen_books.index') }}">2> 尿篩帳籍管制紀錄簿</a></li>
                    <li><a href="{{ route('urine_screen_works.index') }}">3> 執行擴大尿篩工作</a></li>
                </ul>
            </li>
            -->
            <li class="{{ $result1 }}"><a href="#">成果下載</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('year_result') }}">1> 年度成果</a></li>
                </ul>
            </li>
        @endif
    @endauth
</ul>
