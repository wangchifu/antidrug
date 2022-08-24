<?php

namespace App\Http\Controllers;

use App\Models\TzuchiPropaganda;
use App\Models\TzuchiPropagandaPic;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;

class TzuchiPropagandaController extends Controller
{
    public function index()
    {
        $schools = config('antidrug.schools');

        if (!empty(auth()->user()->school_code)) {
            if (auth()->user()->school_code == "074323" or auth()->user()->school_code == "074523") {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', '074323')
                    ->orWhere('school_code', '074523')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            } elseif (auth()->user()->school_code == "074328" or auth()->user()->school_code == "074528") {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', '074328')
                    ->orWhere('school_code', '074528')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            } elseif (auth()->user()->school_code == "074339" or auth()->user()->school_code == "074539") {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', '074339')
                    ->orWhere('school_code', '074539')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            } elseif (auth()->user()->school_code == "074745" or auth()->user()->school_code == "074537") {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', '074745')
                    ->orWhere('school_code', '074537')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            } elseif (auth()->user()->school_code == "074774" or auth()->user()->school_code == "074541") {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', '074774')
                    ->orWhere('school_code', '074541')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            } elseif (auth()->user()->school_code == "074760" or auth()->user()->school_code == "074543") {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', '074760')
                    ->orWhere('school_code', '074543')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            } elseif (auth()->user()->school_code == "074778" or auth()->user()->school_code == "074542") {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', '074778')
                    ->orWhere('school_code', '074542')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            } elseif (auth()->user()->school_code == "074313") {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', '074313')
                    ->orWhere('user_id', '215')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            } elseif (auth()->user()->school_code == "074308") {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', '074308')
                    ->orWhere('user_id', '216')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            } else {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', auth()->user()->school_code)
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            }
        } else {
            if (auth()->user()->id == "215") {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', '074313')
                    ->orWhere('user_id', '215')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            } elseif (auth()->user()->id == "216") {
                $tzuchi_propagandas = TzuchiPropaganda::where('school_code', '074308')
                    ->orWhere('user_id', '216')
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            } else {
                $tzuchi_propagandas = TzuchiPropaganda::where('user_id', auth()->user()->id)
                    ->orderBy('date', 'DESC')
                    ->paginate(10);
            }
        }

        $data = [
            'schools' => $schools,
            'tzuchi_propagandas' => $tzuchi_propagandas,
        ];
        return view('tzuchi_propagandas.index', $data);
    }

    public function create()
    {
        $schools = config('antidrug.schools');

        $data = [
            'schools' => $schools,
        ];
        return view('tzuchi_propagandas.create', $data);
    }

    public function store(Request $request)
    {
        $att = $request->all();
        $tzuchi_propaganda = TzuchiPropaganda::create($att);

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'tzuchi_propagandas/' . $tzuchi_propaganda->id;
            $pics = $request->file('pics');
            $i = 1;
            foreach ($pics as $pic) {
                $pic_name = date('Ymdhis') . '-' . $i . '.' . $pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/tzuchi_propagandas/' . $tzuchi_propaganda->id . '/' . $pic_name));
                $att2['tzuchi_propaganda_id'] = $tzuchi_propaganda->id;
                $att2['pic'] = $pic_name;
                TzuchiPropagandaPic::create($att2);
                $i++;
            }
        }

        return redirect(url('upload1/tzuchi_propaganda/' . $tzuchi_propaganda->id . '/edit#pic_group'));
    }

    public function show(TzuchiPropaganda $tzuchi_propaganda)
    {
        $schools = config('antidrug.schools');

        $pics = TzuchiPropagandaPic::where('tzuchi_propaganda_id', $tzuchi_propaganda->id)->get();

        $data = [
            'schools' => $schools,
            'tzuchi_propaganda' => $tzuchi_propaganda,
            'pics' => $pics,
        ];

        return view('tzuchi_propagandas.show', $data);
    }

    public function print(TzuchiPropaganda $tzuchi_propaganda)
    {
        $schools = config('antidrug.schools');

        $pics = TzuchiPropagandaPic::where('tzuchi_propaganda_id', $tzuchi_propaganda->id)->get();

        $data = [
            'schools' => $schools,
            'tzuchi_propaganda' => $tzuchi_propaganda,
            'pics' => $pics,
        ];

        return view('tzuchi_propagandas.print', $data);
    }

    public function edit(TzuchiPropaganda $tzuchi_propaganda)
    {
        if (empty($tzuchi_propaganda->school_code) and $tzuchi_propaganda->user_id <> auth()->user()->id) {
            return back();
        }

        if ($tzuchi_propaganda->school_code != auth()->user()->school_code) {
            return back();
        }

        $schools = config('antidrug.schools');
        $pics = TzuchiPropagandaPic::where('tzuchi_propaganda_id', $tzuchi_propaganda->id)->get();

        $data = [
            'schools' => $schools,
            'tzuchi_propaganda' => $tzuchi_propaganda,
            'pics' => $pics,
        ];

        return view('tzuchi_propagandas.edit', $data);
    }

    public function update(Request $request, TzuchiPropaganda $tzuchi_propaganda)
    {
        $att = $request->all();
        $tzuchi_propaganda->update($att);
        foreach ($att['pics_desc'] as $k => $v) {
            $pic = TzuchiPropagandaPic::find($k);
            $att2['pic_desc'] = $v;
            $pic->update($att2);
        }

        //處理相片上傳
        if ($request->hasFile('pics')) {
            $folder = 'tzuchi_propagandas/' . $tzuchi_propaganda->id;
            $pics = $request->file('pics');
            $i = 1;
            foreach ($pics as $pic) {
                $pic_name = date('Ymdhis') . '-' . $i . '.' . $pic->getClientOriginalExtension();
                $pic->storeAs('public/' . $folder, $pic_name);

                $img = Image::make($pic);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/tzuchi_propagandas/' . $tzuchi_propaganda->id . '/' . $pic_name));
                $att2['tzuchi_propaganda_id'] = $tzuchi_propaganda->id;
                $att2['pic'] = $pic_name;
                $att2['pic_desc'] = null;
                TzuchiPropagandaPic::create($att2);
                $i++;
            }
        }

        return redirect()->route('tzuchi_propagandas.index');
    }

    public function del_pic(TzuchiPropagandaPic $tzuchi_propaganda_pic)
    {
        $tzuchi_propaganda = TzuchiPropaganda::find($tzuchi_propaganda_pic->tzuchi_propaganda_id);
        if (empty($tzuchi_propaganda->school_code) and $tzuchi_propaganda->user_id <> auth()->user()->id) {
            return back();
        }

        if ($tzuchi_propaganda->school_code != auth()->user()->school_code) {
            return back();
        }

        if (count($tzuchi_propaganda->pics) < 2) {
            return back()->withErrors(['error' => '照片數不得為零']);
        }

        unlink(storage_path('app/public/tzuchi_propagandas/' . $tzuchi_propaganda->id . '/' . $tzuchi_propaganda_pic->pic));

        $tzuchi_propaganda_pic->delete();
        return redirect(url('upload1/tzuchi_propaganda/' . $tzuchi_propaganda->id . '/edit#pic_group'));
    }

    public function destroy(TzuchiPropaganda $tzuchi_propaganda)
    {
        if (empty($tzuchi_propaganda->school_code) and $tzuchi_propaganda->user_id <> auth()->user()->id) {
            return back();
        }

        if ($tzuchi_propaganda->school_code != auth()->user()->school_code) {
            return back();
        }
        deldir(storage_path('app/public/tzuchi_propagandas/' . $tzuchi_propaganda->id));
        TzuchiPropagandaPic::where('tzuchi_propaganda_id', $tzuchi_propaganda->id)
            ->delete();
        $tzuchi_propaganda->delete();
        return redirect()->route('tzuchi_propagandas.index');
    }

    public function review($date1 = null, $date2 = null)
    {
        $date1 = (empty($date1)) ? "2016-01-01" : $date1;
        $date2 = (empty($date2)) ? date('Y-m-d') : $date2;

        $schools = config('antidrug.schools');

        $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
            ->where('date', '<=', $date2)
            ->orderBy('date', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $data = [
            'date1' => $date1,
            'date2' => $date2,
            'schools' => $schools,
            'tzuchi_propagandas' => $tzuchi_propagandas,
        ];
        return view('tzuchi_propagandas.review', $data);
    }

    public function search(Request $request)
    {
        $want = $request->input('want');
        $date1 = $request->input('date1');
        $date2 = $request->input('date2');

        $schools = config('antidrug.schools');

        $users = User::where('name', 'like', '%' . $want . '%')
            ->orWhere('school_name', 'like', '%' . $want . '%')
            ->get();
        $i = 0;
        $user_id_array = [];
        foreach ($users as $user) {
            $user_id_array[$i] = $user->id;
            $i++;
        }

        $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
            ->where('date', '<=', $date2)
            ->whereIn('user_id', $user_id_array)
            ->orderBy('date', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();

        $data = [
            'date1' => $date1,
            'date2' => $date2,
            'schools' => $schools,
            'tzuchi_propagandas' => $tzuchi_propagandas,
        ];
        return view('tzuchi_propagandas.search', $data);
    }

    public function statistics($date1, $date2)
    {
        $schools = config('antidrug.schools');

        $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
            ->where('date', '<=', $date2)
            ->orderBy('date', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();

        $has_upload = [];
        $data = [];
        $i = 0;

        foreach ($tzuchi_propagandas as $tzuchi_propaganda) {
            $data[$i]['宣導日期時間'] = $tzuchi_propaganda->date;
            if (isset($schools[$tzuchi_propaganda->school_code])) {
                $u = $schools[$tzuchi_propaganda->school_code];
                $has_upload[$tzuchi_propaganda->school_code] = 1;
            } else {
                $has_upload[$tzuchi_propaganda->user->name] = 1;
                $u = $tzuchi_propaganda->user->name;
            }
            $data[$i]['單位'] = $u;
            $data[$i]['講題'] = $tzuchi_propaganda->title;
            $data[$i]['講師'] = $tzuchi_propaganda->lecture;
            $data[$i]['活動地點'] = $tzuchi_propaganda->place;
            $data[$i]['參加人數-教職員'] = (int)$tzuchi_propaganda->teacher_times;
            $data[$i]['參加人數-學生'] = (int)$tzuchi_propaganda->student_times;
            $data[$i]['實施情形與效益評估'] = $tzuchi_propaganda->report;
            $data[$i]['檢討與建議'] = $tzuchi_propaganda->content;
            $data[$i]['上傳時間'] = str_replace(" ", "_", $tzuchi_propaganda->created_at);
            $data[$i]['修改時間'] = str_replace(" ", "_", $tzuchi_propaganda->updated_at);
            $i++;
        }

        $users = User::where('type', 'local')
            ->where('admin', null)
            ->where('disable', null)
            ->get();

        $list = collect($data);

        return (new FastExcel($list))->download($date1 . "--" . $date2 . '學生毒品防制宣導.xlsx');
    }
}
