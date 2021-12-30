<?php

namespace App\Http\Controllers;

use App\Models\StudentPropaganda;
use App\Models\StudentPropagandaPic;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;

class StudentPropagandaController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');

        if(!empty(auth()->user()->school_code)){
            if(auth()->user()->school_code == "074323" or auth()->user()->school_code=="074523"){
                $student_propagandas = StudentPropaganda::where('school_code','074323')
                    ->orWhere('school_code','074523')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074328" or auth()->user()->school_code=="074528") {
                $student_propagandas = StudentPropaganda::where('school_code', '074328')
                    ->orWhere('school_code', '074528')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074339" or auth()->user()->school_code=="074539"){
                $student_propagandas = StudentPropaganda::where('school_code','074339')
                    ->orWhere('school_code','074539')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074745" or auth()->user()->school_code=="074537"){
                $student_propagandas = StudentPropaganda::where('school_code','074745')
                    ->orWhere('school_code','074537')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074774" or auth()->user()->school_code=="074541"){
                $student_propagandas = StudentPropaganda::where('school_code','074774')
                    ->orWhere('school_code','074541')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074760" or auth()->user()->school_code=="074543"){
                $student_propagandas = StudentPropaganda::where('school_code','074760')
                    ->orWhere('school_code','074543')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074778" or auth()->user()->school_code=="074542"){
                $student_propagandas = StudentPropaganda::where('school_code','074778')
                    ->orWhere('school_code','074542')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074313"){
                $student_propagandas = StudentPropaganda::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074308"){
                $student_propagandas = StudentPropaganda::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $student_propagandas = StudentPropaganda::where('school_code',auth()->user()->school_code)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }else{
            if(auth()->user()->id=="215"){
                $student_propagandas = StudentPropaganda::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->id=="216"){
                $student_propagandas = StudentPropaganda::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $student_propagandas = StudentPropaganda::where('user_id',auth()->user()->id)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }

        $data = [
            'schools'=>$schools,
            'student_propagandas'=>$student_propagandas,
        ];
        return view('student_propagandas.index',$data);
    }

    public function create()
    {
        $schools = config('antidrug.schools');

        $data = [
            'schools'=>$schools,
        ];
        return view('student_propagandas.create',$data);
    }

    public function store(Request $request)
    {
        $att = $request->all();
        $student_propaganda = StudentPropaganda::create($att);

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'student_propagandas/'.$student_propaganda->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/student_propagandas/'.$student_propaganda->id.'/'.$pic_name));
                $att2['student_propaganda_id'] = $student_propaganda->id;
                $att2['pic'] = $pic_name;
                StudentPropagandaPic::create($att2);
                $i++;
            }
        }

        return redirect(url('upload1/student_propaganda/'.$student_propaganda->id.'/edit#pic_group'));
    }

    public function show(StudentPropaganda $student_propaganda)
    {
        $schools = config('antidrug.schools');

        $pics = StudentPropagandaPic::where('student_propaganda_id',$student_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'student_propaganda'=>$student_propaganda,
            'pics'=>$pics,
        ];

        return view('student_propagandas.show',$data);
    }

    public function print(StudentPropaganda $student_propaganda)
    {
        $schools = config('antidrug.schools');

        $pics = StudentPropagandaPic::where('student_propaganda_id',$student_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'student_propaganda'=>$student_propaganda,
            'pics'=>$pics,
        ];

        return view('student_propagandas.print',$data);
    }

    public function edit(StudentPropaganda $student_propaganda)
    {
        if(empty($student_propaganda->school_code) and $student_propaganda->user_id <> auth()->user()->id){
            return back();
        }

        if($student_propaganda->school_code != auth()->user()->school_code){
            return back();
        }

        $schools = config('antidrug.schools');
        $pics = StudentPropagandaPic::where('student_propaganda_id',$student_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'student_propaganda'=>$student_propaganda,
            'pics'=>$pics,
        ];

        return view('student_propagandas.edit',$data);
    }

    public function update(Request $request,StudentPropaganda $student_propaganda)
    {
        $att = $request->all();
        $student_propaganda->update($att);
        foreach($att['pics_desc'] as $k=>$v){
            $pic = StudentPropagandaPic::find($k);
            $att2['pic_desc'] = $v;
            $pic->update($att2);
        }

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'student_propagandas/'.$student_propaganda->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/student_propagandas/'.$student_propaganda->id.'/'.$pic_name));
                $att2['student_propaganda_id'] = $student_propaganda->id;
                $att2['pic'] = $pic_name;
                $att2['pic_desc'] = null;
                StudentPropagandaPic::create($att2);
                $i++;
            }
        }

        return redirect()->route('student_propagandas.index');
    }

    public function del_pic(StudentPropagandaPic $student_propaganda_pic)
    {
        $student_propaganda = StudentPropaganda::find($student_propaganda_pic->student_propaganda_id);
        if(empty($student_propaganda->school_code) and $student_propaganda->user_id <> auth()->user()->id){
            return back();
        }

        if($student_propaganda->school_code != auth()->user()->school_code){
            return back();
        }

        if(count($student_propaganda->pics)<2){
            return back()->withErrors(['error'=>'照片數不得為零']);
        }

        unlink(storage_path('app/public/student_propagandas/'.$student_propaganda->id.'/'.$student_propaganda_pic->pic));

        $student_propaganda_pic->delete();
        return redirect(url('upload1/student_propaganda/'.$student_propaganda->id.'/edit#pic_group'));
    }

    public function destroy(StudentPropaganda $student_propaganda)
    {
        if(empty($student_propaganda->school_code) and $student_propaganda->user_id <> auth()->user()->id){
            return back();
        }

        if($student_propaganda->school_code != auth()->user()->school_code){
            return back();
        }
        deldir(storage_path('app/public/student_propagandas/'.$student_propaganda->id));
        StudentPropagandaPic::where('student_propaganda_id',$student_propaganda->id)
            ->delete();
        $student_propaganda->delete();
        return redirect()->route('student_propagandas.index');
    }

    public function review($date1=null,$date2=null)
    {
        $date1 = (empty($date1))?"2016-01-01":$date1;
        $date2 = (empty($date2))?date('Y-m-d'):$date2;

        $schools = config('antidrug.schools');

        $student_propagandas = StudentPropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->paginate(10);

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'student_propagandas'=>$student_propagandas,
        ];
        return view('student_propagandas.review',$data);
    }

    public function search(Request $request)
    {
        $want = $request->input('want');
        $date1 = $request->input('date1');
        $date2 = $request->input('date2');

        $schools = config('antidrug.schools');

        $users = User::where('name','like','%'.$want.'%')
            ->orWhere('school_name','like','%'.$want.'%')
            ->get();
        $i=0;
        $user_id_array = [];
        foreach($users as $user){
            $user_id_array[$i] = $user->id;
            $i++;
        }

        $student_propagandas = StudentPropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->whereIn('user_id',$user_id_array)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'student_propagandas'=>$student_propagandas,
        ];
        return view('student_propagandas.search',$data);

    }

    public function statistics($date1,$date2)
    {
        $schools = config('antidrug.schools');

        $student_propagandas = StudentPropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $has_upload = [];
        $data = [];
        $i = 0 ;

        foreach($student_propagandas as $student_propaganda){
            $data[$i]['宣導日期'] = $student_propaganda->date;
            if(isset($schools[$student_propaganda->school_code])){
                $u = $schools[$student_propaganda->school_code];
                $has_upload[$student_propaganda->school_code] = 1;
            }else{
                $has_upload[$student_propaganda->user->name] = 1;
                $u = $student_propaganda->user->name;
            }
            $data[$i]['單位'] = $u;
            $data[$i]['講題'] = $student_propaganda->title;
            $data[$i]['講座'] = $student_propaganda->lecture;
            $data[$i]['活動地點'] = $student_propaganda->place;
            $data[$i]['參加人數-教職員'] = (int)$student_propaganda->teacher_times;
            $data[$i]['參加人數-學生'] = (int)$student_propaganda->student_times;
            $data[$i]['實施情形與效益評估'] = $student_propaganda->report;
            $data[$i]['檢討與建議'] = $student_propaganda->content;
            $data[$i]['上傳時間'] = str_replace(" ","_",$student_propaganda->created_at);
            $data[$i]['修改時間'] = str_replace(" ","_",$student_propaganda->updated_at);
            $i++;
        }

        $users = User::where('type','local')
            ->where('admin',null)
            ->where('disable',null)
            ->get();

//查缺交的
        /**
        foreach($users as $user){
            if(!empty($user->school_code)){
                if(!isset($has_upload[$user->school_code])){
                    $data[$i]['宣導日期'] = "缺交";
                    $data[$i]['單位'] = $user->name;
                    $i++;
                }
            }else{
                if(!isset($has_upload[$user->name])){
                    $data[$i]['宣導日期'] = "缺交";
                    $data[$i]['單位'] = $user->name;
                    $i++;
                }
            }

        }
         * */

        $list = collect($data);

        return (new FastExcel($list))->download($date1."--".$date2.'學生毒品防制宣導.xlsx');
    }
}
