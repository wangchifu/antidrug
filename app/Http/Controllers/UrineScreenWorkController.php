<?php

namespace App\Http\Controllers;

use App\Models\UrineScreenWork;
use App\Models\UrineScreenWorkMember;
use App\Models\User;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class UrineScreenWorkController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');
        if(!empty(auth()->user()->school_code)){
            if(auth()->user()->school_code == "074323" or auth()->user()->school_code=="074523"){
                $urine_screen_works = UrineScreenWork::where('school_code','074323')
                    ->orWhere('school_code','074523')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074328" or auth()->user()->school_code=="074528") {
                $urine_screen_works = UrineScreenWork::where('school_code', '074328')
                    ->orWhere('school_code', '074528')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074339" or auth()->user()->school_code=="074539"){
                $urine_screen_works = UrineScreenWork::where('school_code','074339')
                    ->orWhere('school_code','074539')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074745" or auth()->user()->school_code=="074537"){
                $urine_screen_works = UrineScreenWork::where('school_code','074745')
                    ->orWhere('school_code','074537')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074774" or auth()->user()->school_code=="074541"){
                $urine_screen_works = UrineScreenWork::where('school_code','074774')
                    ->orWhere('school_code','074541')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074760" or auth()->user()->school_code=="074543"){
                $urine_screen_works = UrineScreenWork::where('school_code','074760')
                    ->orWhere('school_code','074543')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074778" or auth()->user()->school_code=="074542"){
                $urine_screen_works = UrineScreenWork::where('school_code','074778')
                    ->orWhere('school_code','074542')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074313"){
                $urine_screen_works = UrineScreenWork::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074308"){
                $urine_screen_works = UrineScreenWork::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $urine_screen_works = UrineScreenWork::where('school_code',auth()->user()->school_code)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }else{
            if(auth()->user()->id=="215"){
                $urine_screen_works = UrineScreenWork::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->id=="216"){
                $urine_screen_works = UrineScreenWork::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $urine_screen_works = UrineScreenWork::where('user_id',auth()->user()->id)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }

        $data = [
            'schools'=>$schools,
            'urine_screen_works'=>$urine_screen_works,
        ];
        return view('urine_screen_works.index',$data);

    }
    public function create()
    {
        $schools = config('antidrug.schools');
        $reagent_brands = config('antidrug.reagent_brands');
        $reagent_types = config('antidrug.reagent_types');

        $data = [
            'schools'=>$schools,
            'reagent_brands'=>$reagent_brands,
            'reagent_types'=>$reagent_types,
        ];
        return view('urine_screen_works.create',$data);
    }

    public function store(Request $request)
    {
        $att = $request->all();
        $att['filename'] = "temp";
        $urine_screen_work = UrineScreenWork::create($att);

        //處理檔案上傳
        if ($request->hasFile('file')) {
            $folder = 'urine_screen_works/'.$urine_screen_work->id;
            $file = $request->file('file');

            $file->storeAs('privacy/' . $folder, $file->getClientOriginalName());
            $att3['filename'] = $file->getClientOriginalName();
            $urine_screen_work->update($att3);
        }

        return redirect()->route('urine_screen_works.agree',$urine_screen_work->id);

    }

    public function agree(UrineScreenWork $urine_screen_work)
    {
        if(empty($urine_screen_work->school_code) and $urine_screen_work->user_id <> auth()->user()->id){
            return back();
        }

        if($urine_screen_work->school_code != auth()->user()->school_code){
            return back();
        }

        $schools = config('antidrug.schools');
        $sexs = config('antidrug.sexs');

        $urine_screen_work_members = UrineScreenWorkMember::where('urine_screen_work_id',$urine_screen_work->id)
            ->get();


        $data = [
            'schools'=>$schools,
            'sexs'=>$sexs,
            'urine_screen_work'=>$urine_screen_work,
            'urine_screen_work_members'=>$urine_screen_work_members,
        ];

        return view('urine_screen_works.agree',$data);
    }

    public function delete_member(UrineScreenWorkMember $urine_screen_work_member)
    {
        $urine_screen_work = UrineScreenWork::find($urine_screen_work_member->urine_screen_work_id);
        if(empty($urine_screen_work->school_code) and $urine_screen_work->user_id <> auth()->user()->id){
            return back();
        }

        if($urine_screen_work->school_code != auth()->user()->school_code){
            return back();
        }

        $urine_screen_work_member->delete();

        return redirect()->route('urine_screen_works.agree',$urine_screen_work->id);
    }

    public function store_member(Request $request)
    {
        $att = $request->all();
        UrineScreenWorkMember::create($att);

        return redirect()->route('urine_screen_works.agree',$att['urine_screen_work_id']);
    }

    public function import_member(Request $request)
    {
        //處理檔案上傳
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $collection = (new FastExcel)->import($file);
            //dd($collection);
            foreach($collection as $line){
                $att['urine_screen_work_id'] = $request->input('urine_screen_work_id');
                $att['class'] = $line['班級'];
                $att['number'] = $line['學號'];
                $att['name'] = $line['姓名'];
                $att['sex'] = $line['性別'];
                UrineScreenWorkMember::create($att);
            }
        }
        return redirect()->route('urine_screen_works.agree',$request->input('urine_screen_work_id'));
    }

    public function edit(UrineScreenWork $urine_screen_work)
    {
        if(empty($urine_screen_work->school_code) and $urine_screen_work->user_id <> auth()->user()->id){
            return back();
        }

        if($urine_screen_work->school_code != auth()->user()->school_code){
            return back();
        }

        $schools = config('antidrug.schools');
        $reagent_brands = config('antidrug.reagent_brands');
        $reagent_types = config('antidrug.reagent_types');

        $data = [
            'schools'=>$schools,
            'reagent_brands'=>$reagent_brands,
            'reagent_types'=>$reagent_types,
            'urine_screen_work'=>$urine_screen_work,
        ];

        return view('urine_screen_works.edit',$data);
    }

    public function update(Request $request,UrineScreenWork $urine_screen_work)
    {
        $att = $request->all();
        $urine_screen_work->update($att);

        //處理檔案上傳
        if ($request->hasFile('file')) {
            $folder = 'urine_screen_works/'.$urine_screen_work->id;
            $file = $request->file('file');

            if(file_exists(storage_path('app/privacy/urine_screen_works/'.$urine_screen_work->id.'/'.$urine_screen_work->filename))){
                unlink(storage_path('app/privacy/urine_screen_works/'.$urine_screen_work->id.'/'.$urine_screen_work->filename));
            }
            $file->storeAs('privacy/' . $folder, $file->getClientOriginalName());
            $att3['filename'] = $file->getClientOriginalName();
            $urine_screen_work->update($att3);
        }

        return redirect()->route('urine_screen_works.index');

    }

    public function destroy(UrineScreenWork $urine_screen_work)
    {
        if(empty($urine_screen_work->school_code) and $urine_screen_work->user_id <> auth()->user()->id){
            return back();
        }

        if($urine_screen_work->school_code != auth()->user()->school_code){
            return back();
        }

        UrineScreenWorkMember::where('urine_screen_work_id',$urine_screen_work->id)->delete();

        $urine_screen_work->delete();
        deldir(storage_path('app/privacy/urine_screen_works/'.$urine_screen_work->id));
        return redirect()->route('urine_screen_works.index');
    }


    public function open(UrineScreenWork $urine_screen_work)
    {
        if(empty($urine_screen_work->school_code) and $urine_screen_work->user_id <> auth()->user()->id){
            return back();
        }

        if($urine_screen_work->school_code != auth()->user()->school_code){
            return back();
        }
        $file = storage_path('app/privacy/urine_screen_works/'.$urine_screen_work->id.'/'.$urine_screen_work->filename);
        if(file_exists($file)){
            return response()->file($file);
        }else{
            echo "檔案不存在";
        }
    }

    public function review($date1=null,$date2=null)
    {
        $date1 = (empty($date1))?"2016-01-01":$date1;
        $date2 = (empty($date2))?date('Y-m-d'):$date2;

        $schools = config('antidrug.schools');

        $urine_screen_works = UrineScreenWork::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->paginate(10);

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'urine_screen_works'=>$urine_screen_works,
        ];
        return view('urine_screen_works.review',$data);

    }

    public function review_book(UrineScreenWork $urine_screen_work)
    {
        $schools = config('antidrug.schools');
        $sexs = config('antidrug.sexs');

        $urine_screen_work_members = UrineScreenWorkMember::where('urine_screen_work_id',$urine_screen_work->id)
            ->get();


        $data = [
            'schools'=>$schools,
            'sexs'=>$sexs,
            'urine_screen_work'=>$urine_screen_work,
            'urine_screen_work_members'=>$urine_screen_work_members,
        ];

        return view('urine_screen_works.review_book',$data);
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

        $urine_screen_works = UrineScreenWork::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->whereIn('user_id',$user_id_array)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'urine_screen_works'=>$urine_screen_works,
        ];
        return view('urine_screen_works.search',$data);

    }

    public function statistics($date1,$date2)
    {
        $schools = config('antidrug.schools');

        $urine_screen_works = UrineScreenWork::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $has_upload = [];
        $data = [];
        $i = 0 ;

        foreach($urine_screen_works as $urine_screen_work){
            $data[$i]['調查日期'] = $urine_screen_work->date;
            if(isset($schools[$urine_screen_work->school_code])){
                $u = $schools[$urine_screen_work->school_code];
                $has_upload[$urine_screen_work->school_code] = 1;
            }else{
                $has_upload[$urine_screen_work->user->name] = 1;
                $u = $urine_screen_work->user->name;
            }
            $data[$i]['單位'] = $u;
            $data[$i]['快篩陽性-男'] = (int)$urine_screen_work->positive_boy;
            $data[$i]['快篩陽性-女'] = (int)$urine_screen_work->positive_girl;
            $data[$i]['確認快篩陽性-男'] = (int)$urine_screen_work->confirm_positive_boy;
            $data[$i]['確認快篩陽性-女'] = (int)$urine_screen_work->confirm_positive_girl;
            $chun_hui = ($urine_screen_work->chun_hui==1)?"是":"否";
            $data[$i]['成立春暉小組'] = $chun_hui;
            $data[$i]['檢驗名冊'] = $urine_screen_work->filename;
            $data[$i]['備註'] = $urine_screen_work->note;
            $data[$i]['上傳時間'] = str_replace(" ","_",$urine_screen_work->created_at);
            $data[$i]['修改時間'] = str_replace(" ","_",$urine_screen_work->updated_at);
            $i++;
        }

        $list = collect($data);

        return (new FastExcel($list))->download($date1."--".$date2.'擴大尿篩工作.xlsx');
    }
}
