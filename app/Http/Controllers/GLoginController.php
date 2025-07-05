<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GLoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $schools = config('antidrug.schools');
        if($request->input('chaptcha') != session('chaptcha')){
            return back()->withErrors(['error'=>'驗證碼錯誤','select'=>$request->input('type')]);
        }

        if($request->input('type') == "gsuite"){
            //檢驗gsuite帳密
            $data = array("email"=>$request->input('username'),"password"=>$request->input('password'));
            $data_string = json_encode($data);
            $ch = curl_init('https://school.chc.edu.tw/api/auth');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
            );
            $result = curl_exec($ch);
            $obj = json_decode($result,true);

            if($obj['success']) {
                //非教職員，即跳開
                if($obj['kind'] == "學生"){
                    return back()->withErrors(['error'=>'學生不能登入','select'=>'gsuite']);
                }

                //是否已有此帳號
                $u = explode('@',$request->input('username'));
                $username = $u[0];

                $user = User::where('personid',$obj['edu_key'])
                    ->where('school_code', $obj['code'])           
                    ->first();

                if(empty($user)){
                    //無使用者，即建立使用者資料
                    $att['username'] = $username;
                    $att['name'] = $obj['name'];
                    $att['password'] = bcrypt($request->input('password'));
                    $att['personid'] = $obj['edu_key'];
                    $att['school_code'] = $obj['code'];
                    $att['school_name'] = $schools[$obj['code']];
                    $att['type'] = "gsuite";

                    $user = User::create($att);

                }else{
                    //非教職員，即跳開
                    if($user->disable==1){
                        return back()->withErrors(['error'=>'你被停用了','select'=>'gsuite']);
                    }
                    //有此使用者，即更新使用者資料
                    $att['name'] = $obj['name'];
                    $att['password'] = bcrypt($request->input('password'));
                    $att['personid'] = $obj['edu_key'];
                    $att['school_code'] = $obj['code'];
                    $att['school_name'] = $schools[$obj['code']];

                    $user->update($att);
                }

            }else{
                return back()->withErrors(['error'=>'GSuite認證錯誤','select'=>'gsuite']);
            };
        }elseif($request->input('type') == "local"){
            //是否已有此帳號
            $u = explode('@',$request->input('username'));
            $username = $u[0];

            $user = User::where('username',$username)
                ->where('type','local')
                ->first();
            if(empty($user)){
                return back()->withErrors(['error'=>'本機帳號密碼錯誤，是不是首兩個英文字沒有大寫？','select'=>'local']);
            }else{
                if($user->disable==1){
                    return back()->withErrors(['error'=>'你被停用了','select'=>'local']);
                }
            }
        }
        //登入
        //if(Auth::attempt(['username' => $username,
        //    'password' => $request->input('password')])){
        //}else{
        //    return back()->withErrors(['error'=>'本機帳號密碼錯誤，是不是首兩個英文字沒有大寫？','select'=>'local']);
        //}
        $a['last_login'] = date('Y-m-d H:i:s');
        $user->update($a);
        Auth::login($user);
        return redirect()->route('index');

    }

    public function logout()
    {
        auth()->logout();
        $url = "https://chc.sso.edu.tw/oidc/v1/logout-to-go";
        $post_logout_redirect_uri = env('APP_URL');
        $id_token_hint = session('id_token');
        $link = $url . "?post_logout_redirect_uri=".$post_logout_redirect_uri."&id_token_hint=" . $id_token_hint;
        return redirect($link);        
    }
}
