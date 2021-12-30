<?php

namespace App\Http\Controllers;

use App\Models\BoeActive;
use App\Models\BoeActivePic;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;

class BoeActiveController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');

        if(!empty(auth()->user()->school_code)){
            if(auth()->user()->school_code == "074323" or auth()->user()->school_code=="074523"){
                $boe_actives = BoeActive::where('school_code','074323')
                    ->orWhere('school_code','074523')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074328" or auth()->user()->school_code=="074528") {
                $boe_actives = BoeActive::where('school_code', '074328')
                    ->orWhere('school_code', '074528')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074339" or auth()->user()->school_code=="074539"){
                $boe_actives = BoeActive::where('school_code','074339')
                    ->orWhere('school_code','074539')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074745" or auth()->user()->school_code=="074537"){
                $boe_actives = BoeActive::where('school_code','074745')
                    ->orWhere('school_code','074537')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074774" or auth()->user()->school_code=="074541"){
                $boe_actives = BoeActive::where('school_code','074774')
                    ->orWhere('school_code','074541')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074760" or auth()->user()->school_code=="074543"){
                $boe_actives = BoeActive::where('school_code','074760')
                    ->orWhere('school_code','074543')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074778" or auth()->user()->school_code=="074542"){
                $boe_actives = BoeActive::where('school_code','074778')
                    ->orWhere('school_code','074542')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074313"){
                $boe_actives = BoeActive::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074308"){
                $boe_actives = BoeActive::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $boe_actives = BoeActive::where('school_code',auth()->user()->school_code)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }else{
            if(auth()->user()->id=="215"){
                $boe_actives = BoeActive::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->id=="216"){
                $boe_actives = BoeActive::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $boe_actives = BoeActive::where('user_id',auth()->user()->id)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }

        $data = [
            'schools'=>$schools,
            'boe_actives'=>$boe_actives,
        ];
        return view('boe_actives.index',$data);

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
        return view('boe_actives.create',$data);
    }

    public function store(Request $request)
    {
        $att = $request->all();
        $boe_active = BoeActive::create($att);

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'boe_actives/'.$boe_active->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/boe_actives/'.$boe_active->id.'/'.$pic_name));
                $att2['boe_active_id'] = $boe_active->id;
                $att2['pic'] = $pic_name;
                BoeActivePic::create($att2);
                $i++;
            }
        }

        return redirect(url('upload2/boe_active/'.$boe_active->id.'/edit#pic_group'));

    }

    public function show(BoeActive $boe_active)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = BoeActivePic::where('boe_active_id',$boe_active->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'boe_active'=>$boe_active,
            'pics'=>$pics,
        ];

        return view('boe_actives.show',$data);
    }

    public function print(BoeActive $boe_active)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = BoeActivePic::where('boe_active_id',$boe_active->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'boe_active'=>$boe_active,
            'pics'=>$pics,
        ];

        return view('boe_actives.print',$data);
    }

    public function edit(BoeActive $boe_active)
    {
        if(empty($boe_active->school_code) and $boe_active->user_id <> auth()->user()->id){
            return back();
        }

        if($boe_active->school_code != auth()->user()->school_code){
            return back();
        }

        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');
        $times = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10];
        $pics = BoeActivePic::where('boe_active_id',$boe_active->id)->get();

        $data = [
            'schools'=>$schools,
            'objects'=>$objects,
            'types'=>$types,
            'times'=>$times,
            'boe_active'=>$boe_active,
            'pics'=>$pics,
        ];

        return view('boe_actives.edit',$data);
    }

    public function update(Request $request,BoeActive $boe_active)
    {
        $att = $request->all();
        $boe_active->update($att);
        foreach($att['pics_desc'] as $k=>$v){
            $pic = BoeActivePic::find($k);
            $att2['pic_desc'] = $v;
            $pic->update($att2);
        }

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'boe_actives/'.$boe_active->id;
            $pics = $request->file('pics');
            $i=1;
            foreach($pics as $pic){
                $pic_name = date('Ymdhis').'-'.$i.'.'.$pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/boe_actives/'.$boe_active->id.'/'.$pic_name));
                $att2['boe_active_id'] = $boe_active->id;
                $att2['pic'] = $pic_name;
                $att2['pic_desc'] = null;
                BoeActivePic::create($att2);
                $i++;
            }
        }

        return redirect()->route('boe_actives.index');

    }

    public function del_pic(BoeActivePic $boe_active_pic)
    {
        $boe_active = BoeActive::find($boe_active_pic->boe_active_id);
        if(empty($boe_active->school_code) and $boe_active->user_id <> auth()->user()->id){
            return back();
        }

        if($boe_active->school_code != auth()->user()->school_code){
            return back();
        }

        if(count($boe_active->pics)<2){
            return back()->withErrors(['error'=>'照片數不得為零']);
        }

        unlink(storage_path('app/public/boe_actives/'.$boe_active->id.'/'.$boe_active_pic->pic));

        $boe_active_pic->delete();
        return redirect(url('upload2/boe_active/'.$boe_active->id.'/edit#pic_group'));
    }

    public function destroy(BoeActive $boe_active)
    {
        if(empty($boe_active->school_code) and $boe_active->user_id <> auth()->user()->id){
            return back();
        }

        if($boe_active->school_code != auth()->user()->school_code){
            return back();
        }
        deldir(storage_path('app/public/boe_actives/'.$boe_active->id));
        BoeActivePic::where('boe_active_id',$boe_active->id)
            ->delete();
        $boe_active->delete();
        return redirect()->route('boe_actives.index');
    }

    public function review($date1=null,$date2=null)
    {
        $date1 = (empty($date1))?"2016-01-01":$date1;
        $date2 = (empty($date2))?date('Y-m-d'):$date2;

        $schools = config('antidrug.schools');

        $boe_actives = BoeActive::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->paginate(10);

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'boe_actives'=>$boe_actives,
        ];
        return view('boe_actives.review',$data);

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

        $boe_actives = BoeActive::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->whereIn('user_id',$user_id_array)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'boe_actives'=>$boe_actives,
        ];
        return view('boe_actives.search',$data);

    }

    public function statistics($date1,$date2)
    {
        $schools = config('antidrug.schools');
        $objects = config('antidrug.objects');
        $types = config('antidrug.types');

        $boe_actives = BoeActive::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $has_upload = [];
        $data = [];
        $i = 0 ;

        foreach($boe_actives as $boe_active){
            $data[$i]['宣導日期'] = $boe_active->date;
            if(isset($schools[$boe_active->school_code])){
                $u = $schools[$boe_active->school_code];
                $has_upload[$boe_active->school_code] = 1;
            }else{
                $has_upload[$boe_active->user->name] = 1;
                $u = $boe_active->user->name;
            }
            $data[$i]['單位'] = $u;
            $data[$i]['宣導主題'] = $boe_active->title;
            $data[$i]['宣導對象'] = $objects[$boe_active->object];
            $data[$i]['宣導類別'] = $types[$boe_active->type];
            $data[$i]['宣導人員'] = $boe_active->personnel;
            $data[$i]['宣導地點'] = $boe_active->place;
            $data[$i]['宣導人次'] = (int)$boe_active->person_times;
            $data[$i]['宣導場次'] = (int)$boe_active->times;
            $data[$i]['宣導內容'] = $boe_active->content;
            $data[$i]['宣導成效'] = $boe_active->result;
            $data[$i]['經費來源'] = $boe_active->money_source;
            $data[$i]['經費總額'] = (int)$boe_active->money;
            $data[$i]['上傳時間'] = str_replace(" ","_",$boe_active->created_at);
            $data[$i]['修改時間'] = str_replace(" ","_",$boe_active->updated_at);
            $i++;
        }

        $list = collect($data);

        return (new FastExcel($list))->download($date1."--".$date2.'教育處自辦活動.xlsx');
    }
}
