<?php

namespace App\Http\Controllers;

use App\Models\ParentPropaganda;
use App\Models\ParentPropagandaPic;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;

class ParentPropagandaController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');

        if(!empty(auth()->user()->school_code)){
            if(auth()->user()->school_code == "074323" or auth()->user()->school_code=="074523"){
                $parent_propagandas = ParentPropaganda::where('school_code','074323')
                    ->orWhere('school_code','074523')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074328" or auth()->user()->school_code=="074528") {
                $parent_propagandas = ParentPropaganda::where('school_code', '074328')
                    ->orWhere('school_code', '074528')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074339" or auth()->user()->school_code=="074539"){
                $parent_propagandas = ParentPropaganda::where('school_code','074339')
                    ->orWhere('school_code','074539')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074745" or auth()->user()->school_code=="074537"){
                $parent_propagandas = ParentPropaganda::where('school_code','074745')
                    ->orWhere('school_code','074537')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074774" or auth()->user()->school_code=="074541"){
                $parent_propagandas = ParentPropaganda::where('school_code','074774')
                    ->orWhere('school_code','074541')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074760" or auth()->user()->school_code=="074543"){
                $parent_propagandas = ParentPropaganda::where('school_code','074760')
                    ->orWhere('school_code','074543')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074778" or auth()->user()->school_code=="074542"){
                $parent_propagandas = ParentPropaganda::where('school_code','074778')
                    ->orWhere('school_code','074542')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074313"){
                $parent_propagandas = ParentPropaganda::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074308"){
                $parent_propagandas = ParentPropaganda::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $parent_propagandas = ParentPropaganda::where('school_code',auth()->user()->school_code)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }else{
            if(auth()->user()->id=="215"){
                $parent_propagandas = ParentPropaganda::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->id=="216"){
                $parent_propagandas = ParentPropaganda::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $parent_propagandas = ParentPropaganda::where('user_id',auth()->user()->id)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }

        $data = [
            'schools'=>$schools,
            'parent_propagandas'=>$parent_propagandas,
        ];
        return view('parent_propagandas.index',$data);

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
        return view('parent_propagandas.create',$data);
    }

    public function store(Request $request)
    {
        $att = $request->all();
        $parent_propaganda = ParentPropaganda::create($att);

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'parent_propagandas/'.$parent_propaganda->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/parent_propagandas/'.$parent_propaganda->id.'/'.$pic_name));
                $att2['parent_propaganda_id'] = $parent_propaganda->id;
                $att2['pic'] = $pic_name;
                ParentPropagandaPic::create($att2);
                $i++;
            }
        }

        return redirect(url('upload1/parent_propaganda/'.$parent_propaganda->id.'/edit#pic_group'));

    }

    public function show(ParentPropaganda $parent_propaganda)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = ParentPropagandaPic::where('parent_propaganda_id',$parent_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'parent_propaganda'=>$parent_propaganda,
            'pics'=>$pics,
        ];

        return view('parent_propagandas.show',$data);
    }

    public function print(ParentPropaganda $parent_propaganda)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = ParentPropagandaPic::where('parent_propaganda_id',$parent_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'parent_propaganda'=>$parent_propaganda,
            'pics'=>$pics,
        ];

        return view('parent_propagandas.print',$data);
    }

    public function edit(ParentPropaganda $parent_propaganda)
    {
        if(empty($parent_propaganda->school_code) and $parent_propaganda->user_id <> auth()->user()->id){
            return back();
        }

        if($parent_propaganda->school_code != auth()->user()->school_code){
            return back();
        }

        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = ParentPropagandaPic::where('parent_propaganda_id',$parent_propaganda->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'parent_propaganda'=>$parent_propaganda,
            'pics'=>$pics,
        ];

        return view('parent_propagandas.edit',$data);
    }

    public function update(Request $request,ParentPropaganda $parent_propaganda)
    {
        $att = $request->all();
        $parent_propaganda->update($att);
        foreach($att['pics_desc'] as $k=>$v){
            $pic = ParentPropagandaPic::find($k);
            $att2['pic_desc'] = $v;
            $pic->update($att2);
        }

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'parent_propagandas/'.$parent_propaganda->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/parent_propagandas/'.$parent_propaganda->id.'/'.$pic_name));
                $att2['parent_propaganda_id'] = $parent_propaganda->id;
                $att2['pic'] = $pic_name;
                $att2['pic_desc'] = null;
                ParentPropagandaPic::create($att2);
                $i++;
            }
        }

        return redirect()->route('parent_propagandas.index');

    }

    public function del_pic(ParentPropagandaPic $parent_propaganda_pic)
    {
        $parent_propaganda = ParentPropaganda::find($parent_propaganda_pic->parent_propaganda_id);
        if(empty($parent_propaganda->school_code) and $parent_propaganda->user_id <> auth()->user()->id){
            return back();
        }

        if($parent_propaganda->school_code != auth()->user()->school_code){
            return back();
        }

        if(count($parent_propaganda->pics)<2){
            return back()->withErrors(['error'=>'照片數不得為零']);
        }

        unlink(storage_path('app/public/parent_propagandas/'.$parent_propaganda->id.'/'.$parent_propaganda_pic->pic));

        $parent_propaganda_pic->delete();
        return redirect(url('upload1/parent_propaganda/'.$parent_propaganda->id.'/edit#pic_group'));
    }

    public function destroy(ParentPropaganda $parent_propaganda)
    {
        if(empty($parent_propaganda->school_code) and $parent_propaganda->user_id <> auth()->user()->id){
            return back();
        }

        if($parent_propaganda->school_code != auth()->user()->school_code){
            return back();
        }
        deldir(storage_path('app/public/parent_propagandas/'.$parent_propaganda->id));
        ParentPropagandaPic::where('parent_propaganda_id',$parent_propaganda->id)
            ->delete();
        $parent_propaganda->delete();
        return redirect()->route('parent_propagandas.index');
    }

    public function review($date1=null,$date2=null)
    {
        $date1 = (empty($date1))?"2016-01-01":$date1;
        $date2 = (empty($date2))?date('Y-m-d'):$date2;

        $schools = config('antidrug.schools');

        $parent_propagandas = ParentPropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->paginate(10);

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'parent_propagandas'=>$parent_propagandas,
        ];
        return view('parent_propagandas.review',$data);

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

        $parent_propagandas = ParentPropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->whereIn('user_id',$user_id_array)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'parent_propagandas'=>$parent_propagandas,
        ];
        return view('parent_propagandas.search',$data);

    }

    public function statistics($date1,$date2)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');

        $parent_propagandas = ParentPropaganda::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $has_upload = [];
        $data = [];
        $i = 0 ;

        foreach($parent_propagandas as $parent_propaganda){
            $data[$i]['宣導日期'] = $parent_propaganda->date;
            if(isset($schools[$parent_propaganda->school_code])){
                $u = $schools[$parent_propaganda->school_code];
                $has_upload[$parent_propaganda->school_code] = 1;
            }else{
                $has_upload[$parent_propaganda->user->name] = 1;
                $u = $parent_propaganda->user->name;
            }
            $data[$i]['單位'] = $u;
            $data[$i]['宣導主題'] = $parent_propaganda->title;
            $data[$i]['宣導對象'] = $objects[$parent_propaganda->object];
            $data[$i]['宣導類別'] = $types[$parent_propaganda->type];
            $data[$i]['宣導人員'] = $parent_propaganda->personnel;
            $data[$i]['宣導地點'] = $parent_propaganda->place;
            $data[$i]['宣導人次'] = (int)$parent_propaganda->person_times;
            $data[$i]['宣導場次'] = (int)$parent_propaganda->times;
            $data[$i]['宣導內容'] = $parent_propaganda->content;
            $data[$i]['宣導成效'] = $parent_propaganda->result;
            $data[$i]['經費來源'] = $parent_propaganda->money_source;
            $data[$i]['經費總額'] = (int)$parent_propaganda->money;
            $data[$i]['上傳時間'] = str_replace(" ","_",$parent_propaganda->created_at);
            $data[$i]['修改時間'] = str_replace(" ","_",$parent_propaganda->updated_at);
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

        return (new FastExcel($list))->download($date1."--".$date2.'家長毒品防制宣導.xlsx');
    }
}
