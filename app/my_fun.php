<?php
//轉為kb
if(! function_exists('filesizekb')) {
    function filesizekb($file)
    {
        return number_format(filesize($file) / pow(1024, 1), 2, '.', '');
    }
}

//顯示某目錄下的檔案
if (! function_exists('get_files')) {
    function get_files($folder){
        $files = [];
        $i=0;
        if (is_dir($folder)) {
            if ($handle = opendir($folder)) {
                while (false !== ($name = readdir($handle))) {
                    if ($name != "." && $name != "..") {
                        //去除掉..跟.
                        $files[$i] = $name;
                        $i++;
                    }
                }
                closedir($handle);
            }
        }
        return $files;
    }
}

//刪除某目錄所有檔案
if (! function_exists('deldir')) {
    function deldir($dir) {
        if(is_dir($dir)){
            $dh = opendir($dir);
            while ($file = readdir($dh)) {
                if($file != "." && $file!="..") {
                    $fullpath = $dir."/".$file;
                    if(!is_dir($fullpath)) {
                        unlink($fullpath);
                    } else {
                        deldir($fullpath);
                    }
                }
            }
            closedir($dh);

            //删除当前文件夹：
            if(rmdir($dir)) {
                return true;
            } else {
                return false;
            }
        }

    }
}



//檢查可登入的
function check_login($n){
    if($n==="國小部教學組長") return true;
    if($n==="教學組長") return true;
    if($n==="教師兼教學組長") return true;
    if($n==="教學註冊組長") return true;
    if($n==="研發組長") return true;
    if($n==="課程研發組長") return true;
    if($n==="教學研發組長") return true;
    if($n==="資訊組長") return true;
    if($n==="教務組長") return true;
    if($n==="教務主任") return true;
    if($n==="教導主任") return true;
    if($n==="輔導主任") return true;
    if($n==="輔導室主任") return true;
    if($n==="特教組長") return true;
    if($n==="資料組長") return true;
    if($n==="實研組長") return true;
    if($n==="校長") return true;

    return false;
}

if (! function_exists('cht2num')) {
    function cht2num($c){
        $cht = [
            '一'=>'1',
            '二'=>'2',
            '三'=>'3',
            '四'=>'4',
            '五'=>'5',
            '六'=>'6',
            '七'=>'7',
            '八'=>'8',
            '九'=>'9',
        ];
        return $cht[$c];
    }
}


if (! function_exists('usersId2Names')) {
    function usersId2Names(){
        $users = \App\Models\User::all();
        foreach($users as $user){
            $users2Names[$user->id] = $user->name;
        }
        return $users2Names;
    }
}

//發email
if(! function_exists('send_mail')){
    function send_mail($to,$subject,$body)
    {
        $data = array("subject"=>$subject,"body"=>$body,"receipt"=>"{$to}");
        $data_string = json_encode($data);
        $ch = curl_init('https://school.chc.edu.tw/api/mail');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'AUTHKEY: #chc7237182#')
        );
        $result = curl_exec($ch);
        $obj = json_decode($result,true);
        if( $obj["success"] == true) {
            //echo "<body onload=alert('已mail通知')>";
        };


    }
}

//發email
if(! function_exists('upload_name')){
    function upload_name()
    {
        if(!empty(auth()->user()->school_code)){
            $code = auth()->user()->school_code;
            if(auth()->user()->school_code=="074523") $code="074323";//和美高
            if(auth()->user()->school_code=="074528") $code="074328";//田中高
            if(auth()->user()->school_code=="074339") $code="074539";//成功高
            if(auth()->user()->school_code=="074543") $code="074760";//民權
            if(auth()->user()->school_code=="074541") $code="074774";//信義
            if(auth()->user()->school_code=="074745") $code="074537";//原斗
            if(auth()->user()->school_code=="074778") $code="074542";//鹿江
            return $code;
        }else{
            return auth()->user()->username;
        }
    }
}

//查指定日期為哪一個學期
if(! function_exists('get_date_semester')){
    function get_date_semester($date)
    {
        $d = explode('-',$date);
        //查目前學期
        $y = (int)$d[0] - 1911;
        $array1 = array(8, 9, 10, 11, 12, 1);
        $array2 = array(2, 3, 4, 5, 6, 7);
        if (in_array($d[1], $array1)) {
            if ($d[1] == 1) {
                $this_semester = ($y - 1) . "1";
            } else {
                $this_semester = $y . "1";
            }
        } else {
            $this_semester = ($y - 1) . "2";
        }

        return $this_semester;

    }
}

//查指定日期為哪一個學年
if(! function_exists('get_date_year')){
    function get_date_year($date)
    {
        $d = explode('-',$date);
        //查目前學期
        $y = (int)$d[0] - 1911;
        $array1 = array(8, 9, 10, 11, 12, 1);
        $array2 = array(2, 3, 4, 5, 6, 7);
        if (in_array($d[1], $array1)) {
            if ($d[1] == 1) {
                $this_semester = ($y - 1) . "1";
            } else {
                $this_semester = $y . "1";
            }
        } else {
            $this_semester = ($y - 1) . "2";
        }

        return substr($this_semester,0,-1);

    }
}

function mb_cht_limit($string,$limit){
    if(mb_strlen($string) > $limit){
        return mb_substr($string,0,$limit)."...";
    }else{
        return $string;
    }
}
