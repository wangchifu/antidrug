<?php

namespace App\Http\Controllers;

use App\Models\MonthlyPropaganda;
use App\Models\MonthlyPropagandaPic;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;

class MonthlyPropagandaController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');

        if(!empty(auth()->user()->school_code)){
            if(auth()->user()->school_code == "074323" or auth()->user()->school_code=="074523"){
                $monthly_propagandas = MonthlyPropaganda::where('school_code','074323')
                    ->orWhere('school_code','074523')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074328" or auth()->user()->school_code=="074528") {
                $monthly_propagandas = MonthlyPropaganda::where('school_code', '074328')
                    ->orWhere('school_code', '074528')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074339" or auth()->user()->school_code=="074539"){
                $monthly_propagandas = MonthlyPropaganda::where('school_code','074339')
                    ->orWhere('school_code','074539')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074745" or auth()->user()->school_code=="074537"){
                $monthly_propagandas = MonthlyPropaganda::where('school_code','074745')
                    ->orWhere('school_code','074537')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074774" or auth()->user()->school_code=="074541"){
                $monthly_propagandas = MonthlyPropaganda::where('school_code','074774')
                    ->orWhere('school_code','074541')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074760" or auth()->user()->school_code=="074543"){
                $monthly_propagandas = MonthlyPropaganda::where('school_code','074760')
                    ->orWhere('school_code','074543')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074778" or auth()->user()->school_code=="074542"){
                $monthly_propagandas = MonthlyPropaganda::where('school_code','074778')
                    ->orWhere('school_code','074542')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074313"){
                $monthly_propagandas = MonthlyPropaganda::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074308"){
                $monthly_propagandas = MonthlyPropaganda::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $monthly_propagandas = MonthlyPropaganda::where('school_code',auth()->user()->school_code)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }else{
            if(auth()->user()->id=="215"){
                $monthly_propagandas = MonthlyPropaganda::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->id=="216"){
                $monthly_propagandas = MonthlyPropaganda::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $monthly_propagandas = MonthlyPropaganda::where('user_id',auth()->user()->id)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }

        $data = [
            'schools'=>$schools,
            'monthly_propagandas'=>$monthly_propagandas,
        ];
        return view('monthly_propagandas.index',$data);

    }
    public function create()
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
        ];
        return view('monthly_propagandas.create',$data);
    }

    public function store(Request $request)
    {
        $att = $request->all();
        $monthly_propaganda = MonthlyPropaganda::create($att);

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'monthly_propagandas/'.$monthly_propaganda->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/monthly_propagandas/'.$monthly_propaganda->id.'/'.$pic_name));
                $att2['monthly_propaganda_id'] = $monthly_propaganda->id;
                $att2['pic'] = $pic_name;
                MonthlyPropagandaPic::create($att2);
                $i++;
            }
        }

        return redirect(url('upload1/monthly_propaganda/'.$monthly_propaganda->id.'/edit#pic_group'));

    }

    public function show(MonthlyPropaganda $monthly_propaganda)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = MonthlyPropagandaPic::where('monthly_propaganda_id',$monthly_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'monthly_propaganda'=>$monthly_propaganda,
            'pics'=>$pics,
        ];

        return view('monthly_propagandas.show',$data);
    }

    public function print(MonthlyPropaganda $monthly_propaganda)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = MonthlyPropagandaPic::where('monthly_propaganda_id',$monthly_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'monthly_propaganda'=>$monthly_propaganda,
            'pics'=>$pics,
        ];

        return view('monthly_propagandas.print',$data);
    }

    public function edit(MonthlyPropaganda $monthly_propaganda)
    {
        if(empty($monthly_propaganda->school_code) and $monthly_propaganda->user_id <> auth()->user()->id){
            return back();
        }

        if($monthly_propaganda->school_code != auth()->user()->school_code){
            return back();
        }

        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = MonthlyPropagandaPic::where('monthly_propaganda_id',$monthly_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'monthly_propaganda'=>$monthly_propaganda,
            'pics'=>$pics,
        ];

        return view('monthly_propagandas.edit',$data);
    }

    public function update(Request $request,MonthlyPropaganda $monthly_propaganda)
    {
        $att = $request->all();
        $monthly_propaganda->update($att);
        foreach($att['pics_desc'] as $k=>$v){
            $pic = MonthlyPropagandaPic::find($k);
            $att2['pic_desc'] = $v;
            $pic->update($att2);
        }

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'monthly_propagandas/'.$monthly_propaganda->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/monthly_propagandas/'.$monthly_propaganda->id.'/'.$pic_name));
                $att2['monthly_propaganda_id'] = $monthly_propaganda->id;
                $att2['pic'] = $pic_name;
                $att2['pic_desc'] = null;
                MonthlyPropagandaPic::create($att2);
                $i++;
            }
        }

        return redirect()->route('monthly_propagandas.index');

    }

    public function del_pic(MonthlyPropagandaPic $monthly_propaganda_pic)
    {
        $monthly_propaganda = MonthlyPropaganda::find($monthly_propaganda_pic->monthly_propaganda_id);
        if(empty($monthly_propaganda->school_code) and $monthly_propaganda->user_id <> auth()->user()->id){
            return back();
        }

        if($monthly_propaganda->school_code != auth()->user()->school_code){
            return back();
        }

        if(count($monthly_propaganda->pics)<2){
            return back()->withErrors(['error'=>'照片數不得為零']);
        }

        unlink(storage_path('app/public/monthly_propagandas/'.$monthly_propaganda->id.'/'.$monthly_propaganda_pic->pic));

        $monthly_propaganda_pic->delete();
        return redirect(url('upload1/monthly_propaganda/'.$monthly_propaganda->id.'/edit#pic_group'));
    }

    public function destroy(MonthlyPropaganda $monthly_propaganda)
    {
        if(auth()->user()->admin <> 1){
            if(empty($monthly_propaganda->school_code) and $monthly_propaganda->user_id <> auth()->user()->id){
                return back();
            }
            if($monthly_propaganda->school_code != auth()->user()->school_code){
                return back();
            }
        }

        deldir(storage_path('app/public/monthly_propagandas/'.$monthly_propaganda->id));
        MonthlyPropagandaPic::where('monthly_propaganda_id',$monthly_propaganda->id)
            ->delete();
        $monthly_propaganda->delete();
        if(auth()->user()->admin <> 1){
            return redirect()->route('monthly_propagandas.index');
        }else{
            return redirect()->route('monthly_propagandas.review');
        }
    }

    public function review($date1=null,$date2=null)
    {
        $date1 = (empty($date1))?"2016-01-01":$date1;
        $date2 = (empty($date2))?date('Y-m-d'):$date2;

        $schools = config('antidrug.schools');

        $monthly_propagandas = MonthlyPropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->paginate(10);
        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'monthly_propagandas'=>$monthly_propagandas,
        ];
        return view('monthly_propagandas.review',$data);
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

        $monthly_propagandas = MonthlyPropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->whereIn('user_id',$user_id_array)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();
        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'want'=>$want,
            'schools'=>$schools,
            'monthly_propagandas'=>$monthly_propagandas,
        ];
        return view('monthly_propagandas.search',$data);
    }

    public function statistics($date1,$date2)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');

        $monthly_propagandas = MonthlyPropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $has_upload = [];
        $data = [];
        $i = 0 ;

        foreach($monthly_propagandas as $monthly_propaganda){
            $data[$i]['宣導日期'] = $monthly_propaganda->date;
            if(isset($schools[$monthly_propaganda->school_code])){
                $u = $schools[$monthly_propaganda->school_code];
                $has_upload[$monthly_propaganda->school_code] = 1;
            }else{
                $has_upload[$monthly_propaganda->user->name] = 1;
                $u = $monthly_propaganda->user->name;
            }
            $data[$i]['單位'] = $u;
            $data[$i]['宣導主題'] = $monthly_propaganda->title;
            $data[$i]['宣導對象'] = $objects[$monthly_propaganda->object];
            $data[$i]['宣導類別'] = $types[$monthly_propaganda->type];
            $data[$i]['宣導人員'] = $monthly_propaganda->personnel;
            $data[$i]['宣導地點'] = $monthly_propaganda->place;
            $data[$i]['宣導人次'] = (int)$monthly_propaganda->person_times;
            $data[$i]['宣導場次'] = (int)$monthly_propaganda->times;
            $data[$i]['經費來源'] = $monthly_propaganda->money_source;
            $data[$i]['經費總額'] = (int)$monthly_propaganda->money;
            $data[$i]['上傳時間'] = str_replace(" ","_",$monthly_propaganda->created_at);
            $data[$i]['修改時間'] = str_replace(" ","_",$monthly_propaganda->updated_at);
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

        return (new FastExcel($list))->download($date1."--".$date2.'每月反毒宣導.xlsx');
    }
}
