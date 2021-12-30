<?php

namespace App\Http\Controllers;

use App\Models\UrineScreenBook;
use App\Models\User;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class UrineScreenBookController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');

        if(!empty(auth()->user()->school_code)){
            if(auth()->user()->school_code == "074323" or auth()->user()->school_code=="074523"){
                $urine_screen_books = UrineScreenBook::where('school_code','074323')
                    ->orWhere('school_code','074523')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074328" or auth()->user()->school_code=="074528") {
                $urine_screen_books = UrineScreenBook::where('school_code', '074328')
                    ->orWhere('school_code', '074528')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074339" or auth()->user()->school_code=="074539"){
                $urine_screen_books = UrineScreenBook::where('school_code','074339')
                    ->orWhere('school_code','074539')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074745" or auth()->user()->school_code=="074537"){
                $urine_screen_books = UrineScreenBook::where('school_code','074745')
                    ->orWhere('school_code','074537')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074774" or auth()->user()->school_code=="074541"){
                $urine_screen_books = UrineScreenBook::where('school_code','074774')
                    ->orWhere('school_code','074541')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074760" or auth()->user()->school_code=="074543"){
                $urine_screen_books = UrineScreenBook::where('school_code','074760')
                    ->orWhere('school_code','074543')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074778" or auth()->user()->school_code=="074542"){
                $urine_screen_books = UrineScreenBook::where('school_code','074778')
                    ->orWhere('school_code','074542')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074313"){
                $urine_screen_books = UrineScreenBook::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->school_code == "074308"){
                $urine_screen_books = UrineScreenBook::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $urine_screen_books = UrineScreenBook::where('school_code',auth()->user()->school_code)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }else{
            if(auth()->user()->id=="215"){
                $urine_screen_books = UrineScreenBook::where('school_code','074313')
                    ->orWhere('user_id','215')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }elseif(auth()->user()->id=="216"){
                $urine_screen_books = UrineScreenBook::where('school_code','074308')
                    ->orWhere('user_id','216')
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }else{
                $urine_screen_books = UrineScreenBook::where('user_id',auth()->user()->id)
                    ->orderBy('date','DESC')
                    ->paginate(10);
            }
        }

        $data = [
            'schools'=>$schools,
            'urine_screen_books'=>$urine_screen_books,
        ];
        return view('urine_screen_books.index',$data);

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
        return view('urine_screen_books.create',$data);
    }

    public function store(Request $request)
    {
        $att = $request->all();
        UrineScreenBook::create($att);

        return redirect()->route('urine_screen_books.index');

    }

    public function edit(UrineScreenBook $urine_screen_book)
    {
        if(empty($urine_screen_book->school_code) and $urine_screen_book->user_id <> auth()->user()->id){
            return back();
        }

        if($urine_screen_book->school_code != auth()->user()->school_code){
            return back();
        }

        $schools = config('antidrug.schools');
        $reagent_brands = config('antidrug.reagent_brands');
        $reagent_types = config('antidrug.reagent_types');

        $data = [
            'schools'=>$schools,
            'reagent_brands'=>$reagent_brands,
            'reagent_types'=>$reagent_types,
            'urine_screen_book'=>$urine_screen_book,
        ];

        return view('urine_screen_books.edit',$data);
    }

    public function update(Request $request,UrineScreenBook $urine_screen_book)
    {
        $att = $request->all();
        $urine_screen_book->update($att);

        return redirect()->route('urine_screen_books.index');

    }

    public function destroy(UrineScreenBook $urine_screen_book)
    {
        if(empty($urine_screen_book->school_code) and $urine_screen_book->user_id <> auth()->user()->id){
            return back();
        }

        if($urine_screen_book->school_code != auth()->user()->school_code){
            return back();
        }

        $urine_screen_book->delete();
        return redirect()->route('urine_screen_books.index');
    }

    public function review($date1=null,$date2=null)
    {
        $date1 = (empty($date1))?"2016-01-01":$date1;
        $date2 = (empty($date2))?date('Y-m-d'):$date2;

        $schools = config('antidrug.schools');

        $urine_screen_books = UrineScreenBook::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->paginate(10);

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'urine_screen_books'=>$urine_screen_books,
        ];
        return view('urine_screen_books.review',$data);

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

        $urine_screen_books = UrineScreenBook::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->whereIn('user_id',$user_id_array)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $data = [
            'date1'=>$date1,
            'date2'=>$date2,
            'schools'=>$schools,
            'urine_screen_books'=>$urine_screen_books,
        ];
        return view('urine_screen_books.search',$data);

    }

    public function statistics($date1,$date2)
    {
        $schools = config('antidrug.schools');

        $urine_screen_books = UrineScreenBook::where('date','>=',$date1)
            ->where('date','<=',$date2)
            ->orderBy('date','DESC')
            ->orderBy('created_at','DESC')
            ->get();

        $has_upload = [];
        $data = [];
        $i = 0 ;

        foreach($urine_screen_books as $urine_screen_book){
            $data[$i]['填報日期'] = $urine_screen_book->date;
            if(isset($schools[$urine_screen_book->school_code])){
                $u = $schools[$urine_screen_book->school_code];
                $has_upload[$urine_screen_book->school_code] = 1;
            }else{
                $has_upload[$urine_screen_book->user->name] = 1;
                $u = $urine_screen_book->user->name;
            }
            $data[$i]['單位'] = $u;
            $data[$i]['試劑廠牌'] = $urine_screen_book->reagent_brand;
            $data[$i]['試劑種類'] = $urine_screen_book->reagent_type;
            $data[$i]['領取'] = (int)$urine_screen_book->quantity;
            $data[$i]['陰性'] = (int)$urine_screen_book->negative;
            $data[$i]['陽性'] = (int)$urine_screen_book->positive;
            $data[$i]['結餘'] = (int)$urine_screen_book->remain;
            $data[$i]['備註'] = $urine_screen_book->note;
            $data[$i]['上傳時間'] = str_replace(" ","_",$urine_screen_book->created_at);
            $data[$i]['修改時間'] = str_replace(" ","_",$urine_screen_book->updated_at);
            $i++;
        }

        $list = collect($data);

        return (new FastExcel($list))->download($date1."--".$date2.'尿篩帳籍管制紀錄簿.xlsx');
    }
}
