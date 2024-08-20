<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class PlanController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');
        if(!empty(auth()->user()->school_code)){
            if(auth()->user()->school_code == "074323" or auth()->user()->school_code=="074523"){
                $plans = Plan::where('school_code','074323')
                    ->orWhere('school_code','074523')
                    ->orderBy('year','DESC')
                    ->get();
            }elseif(auth()->user()->school_code == "074328" or auth()->user()->school_code=="074528") {
                $plans = Plan::where('school_code', '074328')
                    ->orWhere('school_code', '074528')
                    ->orderBy('year', 'DESC')
                    ->get();
            }elseif(auth()->user()->school_code == "074339" or auth()->user()->school_code=="074539"){
                $plans = Plan::where('school_code','074339')
                    ->orWhere('school_code','074539')
                    ->orderBy('year','DESC')
                    ->get();
            }elseif(auth()->user()->school_code == "074745" or auth()->user()->school_code=="074537"){
                $plans = Plan::where('school_code','074745')
                    ->orWhere('school_code','074537')
                    ->orderBy('year','DESC')
                    ->get();
            }elseif(auth()->user()->school_code == "074774" or auth()->user()->school_code=="074541"){
                $plans = Plan::where('school_code','074774')
                    ->orWhere('school_code','074541')
                    ->orderBy('year','DESC')
                    ->get();
            }elseif(auth()->user()->school_code == "074760" or auth()->user()->school_code=="074543"){
                $plans = Plan::where('school_code','074760')
                    ->orWhere('school_code','074543')
                    ->orderBy('year','DESC')
                    ->get();
            }elseif(auth()->user()->school_code == "074778" or auth()->user()->school_code=="074542"){
                $plans = Plan::where('school_code','074778')
                    ->orWhere('school_code','074542')
                    ->orderBy('year','DESC')
                    ->get();
            }elseif(auth()->user()->school_code == "074313"){
                $plans = Plan::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('year','DESC')
                    ->get();
            }elseif(auth()->user()->school_code == "074308"){
                $plans = Plan::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('year','DESC')
                    ->get();
            }else{
                $plans = Plan::where('school_code',auth()->user()->school_code)
                    ->orderBy('year','DESC')
                    ->get();
            }
        }else{
            if(auth()->user()->id=="215"){
                $plans = Plan::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('year','DESC')
                    ->get();
            }elseif(auth()->user()->id=="216"){
                $plans = Plan::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('year','DESC')
                    ->get();
            }else{
                $plans = Plan::where('user_id',auth()->user()->id)
                    ->orderBy('year','DESC')
                    ->get();
            }
        }
        $status = config('antidrug.plan_status');

        $data = [
            'schools'=>$schools,
            'plans'=>$plans,
            'status'=>$status,
        ];

        return view('plans.index',$data);
    }

    public function store(Request $request)
    {
        //不得超過5120KB=5MB
        $request->validate([
            'year'=>'required',
            'files' => 'nullable|max:5120',
        ]);
        $att = $request->all();

        if(!empty(auth()->user()->school_code)){
            $plan = Plan::where('year',$att['year'])->where('school_code',auth()->user()->school_code)->first();
        }else{
            $plan = Plan::where('year',$att['year'])->where('user_id',auth()->user()->id)->first();
        }

        if(empty($plan)){
            //處理檔案上傳
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $upload_name = upload_name();
                $folder = 'plans/'.$att['year'].'/'.$upload_name;

                $file->storeAs('public/' . $folder, $file->getClientOriginalName());
                $att['file'] = $file->getClientOriginalName();
            }
            Plan::create($att);
            return redirect()->route('plans.index');
        }else{
            if($plan->status == 1 or $plan->status == 3 or $plan->status == 4){
                return back()->withErrors(['error'=>'已送審；已覆審；已通過者，不得重送！']);
            }else{
                //處理檔案上傳
                if ($request->hasFile('file')) {
                    $file = $request->file('file');

                    $upload_name = upload_name();
                    $folder = 'plans/'.$att['year'].'/'.$upload_name;

                    $file->storeAs('public/' . $folder, $file->getClientOriginalName());
                    $att['file'] = $file->getClientOriginalName();
                }
                if(file_exists(storage_path('app/public/plans/'.$att['year'].'/'.$upload_name.'/'.$plan->file))){
                    unlink(storage_path('app/public/plans/'.$att['year'].'/'.$upload_name.'/'.$plan->file));
                }
                $plan->update($att);
                return redirect()->route('plans.index');
            }
        }
    }

    public function submit(Plan $plan)
    {
        if(empty($plan->scholl_code) and $plan->user_id <> auth()->user()->id){
            return back();
        }

        if($plan->school_code != auth()->user()->school_code){
            return back();
        }

        $att['status'] = 1;
        $plan->update($att);

        return redirect()->route('plans.index');
    }

    public function destroy(Plan $plan)
    {
        if(empty($plan->school_code) and $plan->user_id <> auth()->user()->id){
            return back();
        }

        if($plan->school_code != auth()->user()->school_code){
            return back();
        }

        if($plan->status <> 0){
            return back();
        }

        $upload_name = upload_name();
        if(file_exists(storage_path('app/public/plans/'.$plan->year.'/'.$upload_name.'/'.$plan->file))){
            unlink(storage_path('app/public/plans/'.$plan->year.'/'.$upload_name.'/'.$plan->file));
        }
        $plan->delete();
        return redirect()->route('plans.index');

    }

    public function review($this_year=null)
    {

        $schools = config('antidrug.schools');
        $this_year = (empty($this_year))?get_date_year(date('Y-m-d')):$this_year;
        $page = (empty($_GET['page']))?1:$_GET['page'];

        $status = config('antidrug.plan_status');
        $plans = Plan::where('year',$this_year)
            ->orderBy('created_at','DESC')
            ->paginate(20);

        $data = [
            'schools'=>$schools,
            'this_year'=>$this_year,
            'status'=>$status,
            'plans'=>$plans,
            'page'=>$page,
        ];
        return view('plans.review',$data);
    }

    public function ok($year,Plan $plan,$page)
    {
        $att['review_desc'] = null;
        $att['review_user_id'] = auth()->user()->id;
        $att['reviewed_at'] = date('Y-m-d H:i:s');
        $att['status'] =4;
        $plan->update($att);
        return redirect('review1/plans/'.$year.'?page='.$page);
    }

    public function back(Request $request,Plan $plan)
    {
        $page = $request->input('page');
        $att['review_desc'] = $request->input('review_desc');
        $att['review_user_id'] = auth()->user()->id;
        $att['reviewed_at'] = date('Y-m-d H:i:s');
        $att['status'] = 2;
        $plan->update($att);
        return redirect('review1/plans/'.$plan->year.'?page='.$page);
    }

    public function search(Request $request)
    {
        $want = $request->input('want');
        $this_year = $request->input('this_year');
        $page = $request->input('page');

        $schools = config('antidrug.schools');

        $status = config('antidrug.plan_status');

        $users = User::where('name','like','%'.$want.'%')
            ->orWhere('school_name','like','%'.$want.'%')
            ->get();
        $i=0;
        $user_id_array = [];
        foreach($users as $user){
            $user_id_array[$i] = $user->id;
            $i++;
        }

        //dd($user_id_array);

        $plans = Plan::where('year',$this_year)
            ->whereIn('user_id',$user_id_array)
            ->orderBy('created_at','DESC')
            ->get();

        $data = [
            'this_year'=>$this_year,
            'want'=>$want,
            'page'=>$page,
            'schools'=>$schools,
            'status'=>$status,
            'plans'=>$plans,
        ];
        return view('plans.search',$data);
    }

    public function statistics($year)
    {
        $schools = config('antidrug.schools');
        $schools2 = array_flip($schools);
        $schools_no = config('antidrug.schools_no');
        $status = config('antidrug.plan_status');

        $plans = Plan::where('year',$year)
            ->orderBy('created_at')
            ->get();

        $data = [];

        foreach($plans as $plan){
            if(isset($schools[$plan->school_code])){
                $u = $schools[$plan->school_code];
                $no = $plan->school_code;
            }else{
                $u = $plan->user->name;
                $no = $plan->user->id;
            }
            $data[$no]['狀態'] = $status[$plan->status];
            $data[$no]['年度'] = $plan->year;
            $data[$no]['單位'] = $u;
            $data[$no]['檔案'] = $plan->file;
            $data[$no]['上傳時間'] = str_replace(" ","_",$plan->created_at);
            $data[$no]['修改時間'] = str_replace(" ","_",$plan->updated_at);
        }

        $i = 0;
        foreach($schools_no as $k=>$v){
            if(isset($data[$schools2[$k]])){
                $excel[$i] = $data[$schools2[$k]];
                unset($data[$schools2[$k]]);
            }else{
                $excel[$i]['狀態'] = "缺交";
                $excel[$i]['年度'] = (int)$year;
                $excel[$i]['單位'] = $k;
            }
            $i++;
        }
        foreach($data as $k=>$v){
            $excel[$i] = $v;
            $i++;
        }


        $list = collect($excel);

        return (new FastExcel($list))->download($year.'年各校年度計畫.xlsx');
    }
}
