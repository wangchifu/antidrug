<?php

namespace App\Http\Controllers;

use App\Models\TelephonePropaganda;
use App\Models\TelephonePropagandaPic;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;

class TelephonePropagandaController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');

        if(!empty(auth()->user()->school_code)){
            if(auth()->user()->school_code == "074323" or auth()->user()->school_code=="074523"){
                $telephone_propagandas = TelephonePropaganda::where('school_code','074323')
                    ->orWhere('school_code','074523')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074328" or auth()->user()->school_code=="074528") {
                $telephone_propagandas = TelephonePropaganda::where('school_code', '074328')
                    ->orWhere('school_code', '074528')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074339" or auth()->user()->school_code=="074539"){
                $telephone_propagandas = TelephonePropaganda::where('school_code','074339')
                    ->orWhere('school_code','074539')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074745" or auth()->user()->school_code=="074537"){
                $telephone_propagandas = TelephonePropaganda::where('school_code','074745')
                    ->orWhere('school_code','074537')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074774" or auth()->user()->school_code=="074541"){
                $telephone_propagandas = TelephonePropaganda::where('school_code','074774')
                    ->orWhere('school_code','074541')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074760" or auth()->user()->school_code=="074543"){
                $telephone_propagandas = TelephonePropaganda::where('school_code','074760')
                    ->orWhere('school_code','074543')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074778" or auth()->user()->school_code=="074542"){
                $telephone_propagandas = TelephonePropaganda::where('school_code','074778')
                    ->orWhere('school_code','074542')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074313"){
                $telephone_propagandas = TelephonePropaganda::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074308"){
                $telephone_propagandas = TelephonePropaganda::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $telephone_propagandas = TelephonePropaganda::where('school_code',auth()->user()->school_code)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }else{
            if(auth()->user()->id=="215"){
                $telephone_propagandas = TelephonePropaganda::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->id=="216"){
                $telephone_propagandas = TelephonePropaganda::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $telephone_propagandas = TelephonePropaganda::where('user_id',auth()->user()->id)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }

        $data = [
            'schools'=>$schools,
            'telephone_propagandas'=>$telephone_propagandas,
        ];
        return view('telephone_propagandas.index',$data);

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
        return view('telephone_propagandas.create',$data);
    }

    public function store(Request $request)
    {
        $att = $request->all();
        $telephone_propaganda = TelephonePropaganda::create($att);

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'telephone_propagandas/'.$telephone_propaganda->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/telephone_propagandas/'.$telephone_propaganda->id.'/'.$pic_name));
                $att2['telephone_propaganda_id'] = $telephone_propaganda->id;
                $att2['pic'] = $pic_name;
                TelephonePropagandaPic::create($att2);
                $i++;
            }
        }

        return redirect(url('upload1/telephone_propaganda/'.$telephone_propaganda->id.'/edit#pic_group'));

    }

    public function show(TelephonePropaganda $telephone_propaganda)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = TelephonePropagandaPic::where('telephone_propaganda_id',$telephone_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'telephone_propaganda'=>$telephone_propaganda,
            'pics'=>$pics,
        ];

        return view('telephone_propagandas.show',$data);
    }

    public function print(TelephonePropaganda $telephone_propaganda)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = TelephonePropagandaPic::where('telephone_propaganda_id',$telephone_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'telephone_propaganda'=>$telephone_propaganda,
            'pics'=>$pics,
        ];

        return view('telephone_propagandas.print',$data);
    }

    public function edit(TelephonePropaganda $telephone_propaganda)
    {
        if(empty($telephone_propaganda->school_code) and $telephone_propaganda->user_id <> auth()->user()->id){
            return back();
        }

        if($telephone_propaganda->school_code != auth()->user()->school_code){
            return back();
        }

        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = TelephonePropagandaPic::where('telephone_propaganda_id',$telephone_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'telephone_propaganda'=>$telephone_propaganda,
            'pics'=>$pics,
        ];

        return view('telephone_propagandas.edit',$data);
    }

    public function update(Request $request,TelephonePropaganda $telephone_propaganda)
    {
        $att = $request->all();
        $telephone_propaganda->update($att);
        foreach($att['pics_desc'] as $k=>$v){
            $pic = TelephonePropagandaPic::find($k);
            $att2['pic_desc'] = $v;
            $pic->update($att2);
        }

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'telephone_propagandas/'.$telephone_propaganda->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/telephone_propagandas/'.$telephone_propaganda->id.'/'.$pic_name));
                $att2['telephone_propaganda_id'] = $telephone_propaganda->id;
                $att2['pic'] = $pic_name;
                $att2['pic_desc'] = null;
                TelephonePropagandaPic::create($att2);
                $i++;
            }
        }

        return redirect()->route('telephone_propagandas.index');

    }

    public function del_pic(TelephonePropagandaPic $telephone_propaganda_pic)
    {
        $telephone_propaganda = TelephonePropaganda::find($telephone_propaganda_pic->telephone_propaganda_id);
        if(empty($telephone_propaganda->school_code) and $telephone_propaganda->user_id <> auth()->user()->id){
            return back();
        }

        if($telephone_propaganda->school_code != auth()->user()->school_code){
            return back();
        }

        if(count($telephone_propaganda->pics)<2){
            return back()->withErrors(['error'=>'照片數不得為零']);
        }

        unlink(storage_path('app/public/telephone_propagandas/'.$telephone_propaganda->id.'/'.$telephone_propaganda_pic->pic));

        $telephone_propaganda_pic->delete();
        return redirect(url('upload1/telephone_propaganda/'.$telephone_propaganda->id.'/edit#pic_group'));
    }

    public function destroy(TelephonePropaganda $telephone_propaganda)
    {
        if(empty($telephone_propaganda->school_code) and $telephone_propaganda->user_id <> auth()->user()->id){
            return back();
        }

        if($telephone_propaganda->school_code != auth()->user()->school_code){
            return back();
        }
        deldir(storage_path('app/public/telephone_propagandas/'.$telephone_propaganda->id));
        TelephonePropagandaPic::where('telephone_propaganda_id',$telephone_propaganda->id)
            ->delete();
        $telephone_propaganda->delete();
        return redirect()->route('telephone_propagandas.index');
    }

    public function review($date1=null,$date2=null)
    {
        $date1 = (empty($date1))?"2016-01-01":$date1;
        $date2 = (empty($date2))?date('Y-m-d'):$date2;

        $schools = config('antidrug.schools');

        $telephone_propagandas = TelephonePropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->paginate(10);

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'telephone_propagandas'=>$telephone_propagandas,
        ];
        return view('telephone_propagandas.review',$data);

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

        $telephone_propagandas = TelephonePropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->whereIn('user_id',$user_id_array)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'telephone_propagandas'=>$telephone_propagandas,
        ];
        return view('telephone_propagandas.search',$data);

    }

    public function statistics($date1,$date2)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');

        $telephone_propagandas = TelephonePropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $has_upload = [];
        $data = [];
        $i = 0 ;

        foreach($telephone_propagandas as $telephone_propaganda){
            $data[$i]['宣導日期'] = $telephone_propaganda->date;
            if(isset($schools[$telephone_propaganda->school_code])){
                $u = $schools[$telephone_propaganda->school_code];
                $has_upload[$telephone_propaganda->school_code] = 1;
            }else{
                $has_upload[$telephone_propaganda->user->name] = 1;
                $u = $telephone_propaganda->user->name;
            }
            $data[$i]['單位'] = $u;
            $data[$i]['宣導主題'] = $telephone_propaganda->title;
            $data[$i]['宣導對象'] = $objects[$telephone_propaganda->object];
            $data[$i]['宣導類別'] = $types[$telephone_propaganda->type];
            $data[$i]['宣導人員'] = $telephone_propaganda->personnel;
            $data[$i]['宣導地點'] = $telephone_propaganda->place;
            $data[$i]['宣導人次'] = (int)$telephone_propaganda->person_times;
            $data[$i]['宣導場次'] = (int)$telephone_propaganda->times;
            $data[$i]['宣導內容'] = $telephone_propaganda->content;
            $data[$i]['宣導成效'] = $telephone_propaganda->result;
            $data[$i]['經費來源'] = $telephone_propaganda->money_source;
            $data[$i]['經費總額'] = (int)$telephone_propaganda->money;
            $data[$i]['上傳時間'] = str_replace(" ","_",$telephone_propaganda->created_at);
            $data[$i]['修改時間'] = str_replace(" ","_",$telephone_propaganda->updated_at);
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

        return (new FastExcel($list))->download($date1."--".$date2.'戒毒成功專線宣導.xlsx');
    }
}
