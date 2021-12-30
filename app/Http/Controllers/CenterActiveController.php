<?php

namespace App\Http\Controllers;

use App\Models\CenterActive;
use App\Models\CenterActivePic;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;

class CenterActiveController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');

        if(!empty(auth()->user()->school_code)){
            if(auth()->user()->school_code == "074323" or auth()->user()->school_code=="074523"){
                $center_actives = CenterActive::where('school_code','074323')
                    ->orWhere('school_code','074523')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074328" or auth()->user()->school_code=="074528") {
                $center_actives = CenterActive::where('school_code', '074328')
                    ->orWhere('school_code', '074528')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074339" or auth()->user()->school_code=="074539"){
                $center_actives = CenterActive::where('school_code','074339')
                    ->orWhere('school_code','074539')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074745" or auth()->user()->school_code=="074537"){
                $center_actives = CenterActive::where('school_code','074745')
                    ->orWhere('school_code','074537')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074774" or auth()->user()->school_code=="074541"){
                $center_actives = CenterActive::where('school_code','074774')
                    ->orWhere('school_code','074541')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074760" or auth()->user()->school_code=="074543"){
                $center_actives = CenterActive::where('school_code','074760')
                    ->orWhere('school_code','074543')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074778" or auth()->user()->school_code=="074542"){
                $center_actives = CenterActive::where('school_code','074778')
                    ->orWhere('school_code','074542')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074313"){
                $center_actives = CenterActive::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074308"){
                $center_actives = CenterActive::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $center_actives = CenterActive::where('school_code',auth()->user()->school_code)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }else{
            if(auth()->user()->id=="215"){
                $center_actives = CenterActive::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->id=="216"){
                $center_actives = CenterActive::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $center_actives = CenterActive::where('user_id',auth()->user()->id)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }

        $data = [
            'schools'=>$schools,
            'center_actives'=>$center_actives,
        ];
        return view('center_actives.index',$data);

    }
    public function create()
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1,2,3,4,5,6,7,8,9,10];

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
        ];
        return view('center_actives.create',$data);
    }

    public function store(Request $request)
    {
        $att = $request->all();
        $att['filename'] = "temp";
        $center_active = CenterActive::create($att);
        //處理檔案上傳
        if ($request->hasFile('file')) {
            $folder = 'center_actives/'.$center_active->id;
            $file = $request->file('file');
            $file->storeAs('public/' . $folder, $file->getClientOriginalName());
        }
        $att2['filename'] = $file->getClientOriginalName();
        $center_active->update($att2);

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'center_actives/'.$center_active->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/center_actives/'.$center_active->id.'/'.$pic_name));
                $att2['center_active_id'] = $center_active->id;
                $att2['pic'] = $pic_name;
                CenterActivePic::create($att2);
                $i++;
            }
        }

        return redirect(url('upload2/center_active/'.$center_active->id.'/edit#pic_group'));

    }

    public function show(CenterActive $center_active)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1,2,3,4,5,6,7,8,9,10];
        $pics = CenterActivePic::where('center_active_id',$center_active->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'center_active'=>$center_active,
            'pics'=>$pics,
        ];

        return view('center_actives.show',$data);
    }

    public function print(CenterActive $center_active)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1,2,3,4,5,6,7,8,9,10];
        $pics = CenterActivePic::where('center_active_id',$center_active->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'center_active'=>$center_active,
            'pics'=>$pics,
        ];

        return view('center_actives.print',$data);
    }

    public function edit(CenterActive $center_active)
    {
        if(empty($center_active->school_code) and $center_active->user_id <> auth()->user()->id){
            return back();
        }

        if($center_active->school_code != auth()->user()->school_code){
            return back();
        }

        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1,2,3,4,5,6,7,8,9,10];
        $pics = CenterActivePic::where('center_active_id',$center_active->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'center_active'=>$center_active,
            'pics'=>$pics,
        ];

        return view('center_actives.edit',$data);
    }

    public function update(Request $request,CenterActive $center_active)
    {
        $att = $request->all();
        $center_active->update($att);
        foreach($att['pics_desc'] as $k=>$v){
            $pic = CenterActivePic::find($k);
            $att2['pic_desc'] = $v;
            $pic->update($att2);
        }

        //處理檔案上傳
        if ($request->hasFile('file')) {
            $folder = 'center_actives/'.$center_active->id;
            $file = $request->file('file');

            if(file_exists(storage_path('app/public/center_actives/'.$center_active->id.'/'.$center_active->filename))){
                unlink(storage_path('app/public/center_actives/'.$center_active->id.'/'.$center_active->filename));
            }
            $file->storeAs('public/' . $folder, $file->getClientOriginalName());
            $att3['filename'] = $file->getClientOriginalName();
            $center_active->update($att3);
        }

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'center_actives/'.$center_active->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/center_actives/'.$center_active->id.'/'.$pic_name));
                $att2['center_active_id'] = $center_active->id;
                $att2['pic'] = $pic_name;
                $att2['pic_desc'] = null;
                CenterActivePic::create($att2);
                $i++;
            }
        }

        return redirect()->route('center_actives.index');

    }

    public function del_pic(CenterActivePic $center_active_pic)
    {
        $center_active = CenterActive::find($center_active_pic->center_active_id);
        if(empty($center_active->school_code) and $center_active->user_id <> auth()->user()->id){
            return back();
        }

        if($center_active->school_code != auth()->user()->school_code){
            return back();
        }

        if(count($center_active->pics)<2){
            return back()->withErrors(['error'=>'照片數不得為零']);
        }

        if(count($center_active->pics) < 2){
            return back()->withErrors(['error'=>'最後一張照片了，不能刪！']);
        }

        unlink(storage_path('app/public/center_actives/'.$center_active->id.'/'.$center_active_pic->pic));

        $center_active_pic->delete();
        return redirect(url('upload2/center_active/'.$center_active->id.'/edit#pic_group'));
    }

    public function destroy(CenterActive $center_active)
    {
        if(empty($center_active->school_code) and $center_active->user_id <> auth()->user()->id){
            return back();
        }

        if($center_active->school_code != auth()->user()->school_code){
            return back();
        }
        deldir(storage_path('app/public/center_actives/'.$center_active->id));
        CenterActivePic::where('center_active_id',$center_active->id)
            ->delete();
        $center_active->delete();
        return redirect()->route('center_actives.index');
    }

    public function review($date1=null,$date2=null)
    {
        $date1 = (empty($date1))?"2016-01-01":$date1;
        $date2 = (empty($date2))?date('Y-m-d'):$date2;

        $schools = config('antidrug.schools');

        $center_actives = CenterActive::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->paginate(10);

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'center_actives'=>$center_actives,
        ];
        return view('center_actives.review',$data);

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

        $center_actives = CenterActive::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->whereIn('user_id',$user_id_array)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'center_actives'=>$center_actives,
        ];
        return view('center_actives.search',$data);

    }

    public function statistics($date1,$date2)
    {
        $schools = config('antidrug.schools');

        $center_actives = CenterActive::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $has_upload = [];
        $data = [];
        $i = 0 ;

        foreach($center_actives as $center_active){
            $data[$i]['活動日期'] = $center_active->date;
            if(isset($schools[$center_active->school_code])){
                $u = $schools[$center_active->school_code];
                $has_upload[$center_active->school_code] = 1;
            }else{
                $has_upload[$center_active->user->name] = 1;
                $u = $center_active->user->name;
            }
            $data[$i]['單位'] = $u;
            $data[$i]['活動主題'] = $center_active->title;
            $data[$i]['宣導地點'] = $center_active->place;
            $data[$i]['參與人次'] = (int)$center_active->person_times;
            $data[$i]['成果檔案'] = $center_active->filename;
            $data[$i]['上傳時間'] = str_replace(" ","_",$center_active->created_at);
            $data[$i]['修改時間'] = str_replace(" ","_",$center_active->updated_at);
            $i++;
        }

        $list = collect($data);

        return (new FastExcel($list))->download($date1."--".$date2.'反毒中心學校成果.xlsx');
    }
}
