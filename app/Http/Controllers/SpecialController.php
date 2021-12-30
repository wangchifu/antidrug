<?php

namespace App\Http\Controllers;

use App\Models\Special;
use App\Models\SpecialMember;
use App\Models\SpecialReagent;
use App\Models\User;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class SpecialController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');

        if(!empty(auth()->user()->school_code)){
            if(auth()->user()->school_code == "074323" or auth()->user()->school_code=="074523"){
                $specials = Special::where('school_code','074323')
                    ->orWhere('school_code','074523')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074328" or auth()->user()->school_code=="074528") {
                $specials = Special::where('school_code', '074328')
                    ->orWhere('school_code', '074528')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074339" or auth()->user()->school_code=="074539"){
                $specials = Special::where('school_code','074339')
                    ->orWhere('school_code','074539')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074745" or auth()->user()->school_code=="074537"){
                $specials = Special::where('school_code','074745')
                    ->orWhere('school_code','074537')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074774" or auth()->user()->school_code=="074541"){
                $specials = Special::where('school_code','074774')
                    ->orWhere('school_code','074541')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074760" or auth()->user()->school_code=="074543"){
                $specials = Special::where('school_code','074760')
                    ->orWhere('school_code','074543')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074778" or auth()->user()->school_code=="074542"){
                $specials = Special::where('school_code','074778')
                    ->orWhere('school_code','074542')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074313"){
                $specials = Special::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074308"){
                $specials = Special::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $specials = Special::where('school_code',auth()->user()->school_code)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }else{
            if(auth()->user()->id=="215"){
                $specials = Special::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->id=="216"){
                $specials = Special::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $specials = Special::where('user_id',auth()->user()->id)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }

        $data = [
            'schools'=>$schools,
            'specials'=>$specials,
        ];
        return view('specials.index',$data);

    }

    public function create()
    {
        $schools = config('antidrug.schools');
        $data = [
            'schools'=>$schools,
        ];
        return view('specials.create',$data);
    }

    public function store(Request $request)
    {
        $att = $request->all();

        $special = Special::create($att);
        //處理檔案上傳
        $att2 = [];
        if($request->hasFile('meeting')) {
            $folder = 'specials/'.$special->id;
            $meeting = $request->file('meeting');
            $meeting->storeAs('privacy/' . $folder, $meeting->getClientOriginalName());
            $att2['meeting_filename'] = $meeting->getClientOriginalName();
        }
        if($request->hasFile('signin')) {
            $folder = 'specials/'.$special->id;
            $signin = $request->file('signin');
            $signin->storeAs('privacy/' . $folder, $signin->getClientOriginalName());
            $att2['signin_filename'] = $signin->getClientOriginalName();
        }

        if(!empty($att2)){
            $special->update($att2);
        }

        return redirect()->route('specials.agree',$special->id);
    }

    public function agree(Special $special)
    {
        if(empty($special->school_code) and $special->user_id <> auth()->user()->id){
            return back();
        }

        if($special->school_code != auth()->user()->school_code){
            return back();
        }

        $schools = config('antidrug.schools');
        $sexs = config('antidrug.sexs');
        $special_types = config('antidrug.special_types');

        $special_members = SpecialMember::where('special_id',$special->id)
            ->get();


        $data = [
            'schools'=>$schools,
            'sexs'=>$sexs,
            'special_types'=>$special_types,
            'special'=>$special,
            'special_members'=>$special_members,
        ];

        return view('specials.agree',$data);
    }

    public function store_member(Request $request)
    {
        $att = $request->all();
        $special_member = SpecialMember::create($att);

        if($request->hasFile('file')) {
            $folder = 'special_members/'.$special_member->id;
            $file = $request->file('file');
            $file->storeAs('privacy/' . $folder, $file->getClientOriginalName());
            $att2['filename'] = $file->getClientOriginalName();
            $special_member->update($att2);
        }

        return redirect(url('upload3/special/'.$att['special_id'].'/agree#list'));
    }

    public function delete_member(SpecialMember $special_member)
    {
        $special = Special::find($special_member->special_id);
        if(empty($special->school_code) and $special->user_id <> auth()->user()->id){
            return back();
        }

        if($special->school_code != auth()->user()->school_code){
            return back();
        }

        deldir(storage_path('app/privacy/special_members/'.$special_member->id));

        $special_member->delete();

        return redirect()->route('specials.agree',$special->id);
    }

    public function open($id,$action)
    {
        if($action == "meeting" or $action == "signin"){
            $special = Special::find($id);
            if(empty($special->school_code) and $special->user_id <> auth()->user()->id and auth()->user()->admin !=1){
                return back();
            }

            if($special->school_code != auth()->user()->school_code and auth()->user()->admin !=1){
                return back();
            }
            if($action == "meeting"){
                $file = storage_path('app/privacy/specials/'.$special->id.'/'.$special->meeting_filename);;
            }
            if($action == "signin"){
                $file = storage_path('app/privacy/specials/'.$special->id.'/'.$special->signin_filename);;
            }
        }

        if($action == "member_agree"){
            $special_member = SpecialMember::find($id);
            $special = Special::find($special_member->special_id);
            if(empty($special->school_code) and $special->user_id <> auth()->user()->id and auth()->user()->admin !=1){
                return back();
            }

            if($special->school_code != auth()->user()->school_code and auth()->user()->admin !=1){
                return back();
            }
            $file = storage_path('app/privacy/special_members/'.$special_member->id.'/'.$special_member->filename);;
        }


        if(file_exists($file)){
            return response()->file($file);
        }else{
            echo "檔案不存在";
        }
    }

    public function reagent(Special $special)
    {
        if(empty($special->school_code) and $special->user_id <> auth()->user()->id){
            return back();
        }

        if($special->school_code != auth()->user()->school_code){
            return back();
        }

        $special_reagents = SpecialReagent::where('special_id',$special->id)->get();

        $schools = config('antidrug.schools');
        $reagent_brands = config('antidrug.reagent_brands');
        $reagent_types = config('antidrug.reagent_types');
        $name_list = [];
        foreach($special->members as $member){
            $name_list[$member->name] = $member->name;
        }

        $data = [
            'special'=>$special,
            'schools'=>$schools,
            'reagent_brands'=>$reagent_brands,
            'reagent_types'=>$reagent_types,
            'name_list'=>$name_list,
            'special_reagents'=>$special_reagents,
        ];

        return view('specials.reagent',$data);
    }

    public function store_reagent(Request $request)
    {
        $att = $request->all();
        SpecialReagent::create($att);
        return redirect(url('upload3/special/'.$att['special_id'].'/reagent#list'));
    }

    public function delete_reagent(SpecialReagent $special_reagent)
    {
        $special = Special::find($special_reagent->special_id);
        if(empty($special->school_code) and $special->user_id <> auth()->user()->id){
            return back();
        }

        if($special->school_code != auth()->user()->school_code){
            return back();
        }
        $special_reagent->delete();
        return redirect(url('upload3/special/'.$special->id.'/reagent#list'));
    }

    public function edit(Special $special)
    {
        if(empty($special->school_code) and $special->user_id <> auth()->user()->id){
            return back();
        }

        if($special->school_code != auth()->user()->school_code){
            return back();
        }

        $schools = config('antidrug.schools');

        $data = [
            'schools'=>$schools,
            'special'=>$special,
        ];

        return view('specials.edit',$data);
    }

    public function update(Request $request,Special $special)
    {
        $att = $request->all();
        $special->update($att);

        //處理檔案上傳
        if ($request->hasFile('meeting')) {
            $folder = 'specials/'.$special->id;
            $meeting = $request->file('meeting');

            if(file_exists(storage_path('app/privacy/specials/'.$special->id.'/'.$special->meeting_filename))){
                unlink(storage_path('app/privacy/specials/'.$special->id.'/'.$special->meeting_filename));
            }
            $meeting->storeAs('privacy/' . $folder, $meeting->getClientOriginalName());
            $att3['meeting_filename'] = $meeting->getClientOriginalName();
            $special->update($att3);
        }
        //處理檔案上傳
        if ($request->hasFile('signin')) {
            $folder = 'specials/'.$special->id;
            $signin = $request->file('signin');

            if(file_exists(storage_path('app/privacy/specials/'.$special->id.'/'.$special->signin_filename))){
                unlink(storage_path('app/privacy/specials/'.$special->id.'/'.$special->signin_filename));
            }
            $signin->storeAs('privacy/' . $folder, $signin->getClientOriginalName());
            $att3['signin_filename'] = $signin->getClientOriginalName();
            $special->update($att3);
        }

        return redirect()->route('specials.index');

    }

    public function destroy(Special $special)
    {
        if(empty($special->school_code) and $special->user_id <> auth()->user()->id){
            return back();
        }

        if($special->school_code != auth()->user()->school_code){
            return back();
        }
        deldir(storage_path('app/privacy/specials/'.$special->id));

        $special_members = SpecialMember::where('special_id',$special->id)->get();
        foreach($special_members as $special_member){
            deldir(storage_path('app/privacy/special_members/'.$special_member->id));
            $special_member->delete();
        }

        $special_reagents = SpecialReagent::where('special_id',$special->id)->delete();

        $special->delete();
        return redirect()->route('specials.index');
    }

    public function review($date1=null,$date2=null)
    {
        $date1 = (empty($date1))?"2016-01-01":$date1;
        $date2 = (empty($date2))?date('Y-m-d'):$date2;

        $schools = config('antidrug.schools');

        $specials = Special::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->paginate(10);

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'specials'=>$specials,
        ];
        return view('specials.review',$data);
    }

    public function review_book(Special $special)
    {
        $schools = config('antidrug.schools');
        $sexs = config('antidrug.sexs');
        $reagent_brands = config('antidrug.reagent_brands');
        $reagent_types = config('antidrug.reagent_types');

        $special_types = config('antidrug.special_types');

        $special_members = SpecialMember::where('special_id',$special->id)
            ->get();

        $special_reagents = SpecialReagent::where('special_id',$special->id)->get();

        $name_list = [];
        foreach($special->members as $member){
            $name_list[$member->name] = $member->name;
        }

        $data = [
            'schools'=>$schools,
            'sexs'=>$sexs,
            'reagent_brands'=>$reagent_brands,
            'reagent_types'=>$reagent_types,
            'special_types'=>$special_types,
            'special'=>$special,
            'special_members'=>$special_members,
            'name_list'=>$name_list,
            'special_reagents'=>$special_reagents,
        ];

        return view('specials.review_book',$data);
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

        $specials = Special::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->whereIn('user_id',$user_id_array)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'specials'=>$specials,
        ];
        return view('specials.search',$data);

    }

    public function statistics($date1,$date2)
    {
        $schools = config('antidrug.schools');

        $specials = Special::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $has_upload = [];
        $data = [];
        $i = 0 ;

        foreach($specials as $special){
            $data[$i]['填報日期'] = $special->date;
            if(isset($schools[$special->school_code])){
                $u = $schools[$special->school_code];
                $has_upload[$special->school_code] = 1;
            }else{
                $has_upload[$special->user->name] = 1;
                $u = $special->user->name;
            }
            $data[$i]['單位'] = $u;
            $yes_no = ($special->yes_no==1)?"是":"否";
            $data[$i]['特定人員'] = $yes_no;
            $data[$i]['會議紀錄'] = $special->meeting_filename;
            $data[$i]['簽到表'] = $special->signin_filename;
            $data[$i]['人員總數'] = (int)count($special->members);
            $s[1]['男'] = 0;
            $s[1]['女'] = 0;
            $s[2]['男'] = 0;
            $s[2]['女'] = 0;
            $s[3]['男'] = 0;
            $s[3]['女'] = 0;
            $s[4]['男'] = 0;
            $s[4]['女'] = 0;
            $s[5]['男'] = 0;
            $s[5]['女'] = 0;
            if(count($special->members) > 0 ){
                foreach($special->members as $member){
                    $s[$member->special_type][$member->sex]++;
                }
            }
            $data[$i]['類別1-男'] = (int)$s[1]['男'];
            $data[$i]['類別1-女'] = (int)$s[1]['女'];
            $data[$i]['類別2-男'] = (int)$s[2]['男'];
            $data[$i]['類別2-女'] = (int)$s[2]['女'];
            $data[$i]['類別3-男'] = (int)$s[3]['男'];
            $data[$i]['類別3-女'] = (int)$s[3]['女'];
            $data[$i]['類別4-男'] = (int)$s[4]['男'];
            $data[$i]['類別4-女'] = (int)$s[4]['女'];
            $data[$i]['類別5-男'] = (int)$s[5]['男'];
            $data[$i]['類別5-女'] = (int)$s[5]['女'];
            $data[$i]['上傳時間'] = str_replace(" ","_",$special->created_at);
            $data[$i]['修改時間'] = str_replace(" ","_",$special->updated_at);
            $i++;
        }

        $list = collect($data);

        return (new FastExcel($list))->download($date1."--".$date2.'特定人員名冊.xlsx');
    }
}
