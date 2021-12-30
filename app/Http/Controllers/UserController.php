<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');
        $users = User::orderBy('id')
            ->paginate('20');

        $data = [
            'users'=>$users,
            'schools'=>$schools,
        ];
        return view('users.index',$data);
    }

    public function search(Request $request)
    {
        $schools = config('antidrug.schools');

        $want = $request->input('want');

        $users = User::where('username','like','%'.$want.'%')
            ->orWhere('name','like','%'.$want.'%')
            ->orWhere('school_name','like','%'.$want.'%')
            ->paginate('100');

        $data = [
            'users'=>$users,
            'schools'=>$schools,
        ];
        return view('users.index',$data);
    }

    public function create()
    {
        $data = [

        ];
        return view('users.create',$data);
    }

    public function store(Request $request)
    {
        $att['admin'] = $request->input('admin');
        $att['username'] = $request->input('username');
        $att['password'] = bcrypt($request->input('password'));
        $att['name'] = $request->input('name');
        $att['email'] = $request->input('email');
        $att['note'] = $request->input('note');
        $att['type'] = $request->input('type');
        if($att['admin'] == 1){
            $admin_level = $request->input('admin_level');

            $att['admin_level'] = "";
            foreach($admin_level as $k=>$v){
                $att['admin_level'] .= $v.',';
            }

            $att['admin_level'] = substr($att['admin_level'],0,-1);

        }else{
            $att['admin'] = null;
            $att['special'] = $request->input('special');
            $att['class'] = $request->input('class');
            if($att['class']==1){
                $att['area'] = $request->input('area');
            }else{
                $att['area'] = null;
            }
            $menu = $request->input('menu');

            $att['menu'] = "";
            foreach($menu as $k=>$v){
                $att['menu'] .= $v.',';
            }
            $att['menu'] = substr($att['menu'],0,-1);
        }
        User::create($att);
        return redirect()->route('users.index');
    }

    public function disable(User $user)
    {
        if($user->disable==1){
            $att['disable'] = null;
        }else{
            $att['disable'] = 1;
        }
        $user->update($att);
        return redirect()->route('users.index');
    }

    public function reset_pwd(User $user)
    {
        $att['password'] = bcrypt(env('DEFAULT_PWD'));
        $user->update($att);
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $data = [
            'user'=>$user,
        ];
        return view('users.edit',$data);
    }

    public function update(Request $request,User $user)
    {
        $att = $request->all();
        if($user->admin==1){
            $admin_level = $request->input('admin_level');

            $att['admin_level'] = "";
            foreach($admin_level as $k=>$v){
                $att['admin_level'] .= $v.',';
            }

            $att['admin_level'] = substr($att['admin_level'],0,-1);
        }else{
            $att['admin'] = null;
            $att['special'] = $request->input('special');
            $att['class'] = $request->input('class');
            if($att['class']==1){
                $att['area'] = $request->input('area');
            }else{
                $att['area'] = null;
            }
            $menu = $request->input('menu');

            $att['menu'] = "";
            foreach($menu as $k=>$v){
                $att['menu'] .= $v.',';
            }
            $att['menu'] = substr($att['menu'],0,-1);
        }
        $user->update($att);
        return redirect()->route('users.index');
    }
}
