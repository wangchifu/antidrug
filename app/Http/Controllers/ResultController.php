<?php

namespace App\Http\Controllers;

use App\Models\EducatorPropaganda;
use App\Models\MonthlyPropaganda;
use App\Models\OtherPropaganda;
use App\Models\ParentPropaganda;
use App\Models\StudentPropaganda;
use App\Models\TelephonePropaganda;
use App\Models\TzuchiPropaganda;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class ResultController extends Controller
{
    public function year_result($this_year = null)
    {
        $schools = config('antidrug.schools');
        $this_year = (empty($this_year)) ? get_date_year(date('Y-m-d')) : $this_year;

        $data = [
            'schools' => $schools,
            'this_year' => $this_year,
        ];
        return view('results.year_result', $data);
    }

    public function year_result_download($this_year)
    {

        $schools = config('antidrug.schools');
        $schools_no = config('antidrug.schools_no');
        $no = (!empty(auth()->user()->school_code)) ? $schools_no[$schools[auth()->user()->school_code]] : 0;
        $school_name = (!empty(auth()->user()->school_name)) ? auth()->user()->school_name : auth()->user()->name;
        $filename = $no . "-" . $school_name . "-" . $this_year . "年度反毒工作成果.docx";


        $templateProcessor = new TemplateProcessor(asset('files/sample.docx'));
        $templateProcessor->setValue('year', $this_year);
        $templateProcessor->setValue('school_name', $school_name);

        $date1 = ($this_year + 1911) . "-01-01";
        $date2 = ($this_year + 1911) . "-11-30";
        $i = 1;
        $images = [];


        if (!empty(auth()->user()->school_code)) {
            if (auth()->user()->school_code == "074323" or auth()->user()->school_code == "074523") {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074323')
                            ->orWhere('school_code', '074523');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074328" or auth()->user()->school_code == "074528") {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074328')
                            ->orWhere('school_code', '074528');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074339" or auth()->user()->school_code == "074539") {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074339')
                            ->orWhere('school_code', '074539');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074745" or auth()->user()->school_code == "074537") {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074745')
                            ->orWhere('school_code', '074537');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074774" or auth()->user()->school_code == "074541") {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074774')
                            ->orWhere('school_code', '074541');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074760" or auth()->user()->school_code == "074543") {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074760')
                            ->orWhere('school_code', '074543');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074778" or auth()->user()->school_code == "074542") {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074778')
                            ->orWhere('school_code', '074542');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074313") {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074308") {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('school_code', auth()->user()->school_code)
                    ->orderBy('date')
                    ->get();
            }
        } else {
            if (auth()->user()->id == "215") {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->id == "216") {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $monthly_propagandas = MonthlyPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('user_id', auth()->user()->id)
                    ->orderBy('date')
                    ->get();
            }
        }


        $monthly = "";
        foreach ($monthly_propagandas as $monthly_propaganda) {
            $monthly .= $monthly_propaganda->date . " " . $monthly_propaganda->title . "(" . $monthly_propaganda->person_times . "人次)<w:br />";
            $j = 1;
            foreach ($monthly_propaganda->pics as $pic) {
                $images[$i]['path'] = asset('storage/monthly_propagandas/' . $monthly_propaganda->id . '/' . $pic->pic);
                $images[$i]['file'] = storage_path('app/public/monthly_propagandas/' . $monthly_propaganda->id . '/' . $pic->pic);
                $images[$i]['desc'] = $monthly_propaganda->date . $pic->pic_desc;
                $i++;
                $j++;
                if ($j == 3) break;
            }
        }


        $templateProcessor->setValue('monthly', $monthly);

        if (!empty(auth()->user()->school_code)) {
            if (auth()->user()->school_code == "074323" or auth()->user()->school_code == "074523") {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074323')
                            ->orWhere('school_code', '074523');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074328" or auth()->user()->school_code == "074528") {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074328')
                            ->orWhere('school_code', '074528');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074339" or auth()->user()->school_code == "074539") {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074339')
                            ->orWhere('school_code', '074539');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074745" or auth()->user()->school_code == "074537") {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074745')
                            ->orWhere('school_code', '074537');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074774" or auth()->user()->school_code == "074541") {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074774')
                            ->orWhere('school_code', '074541');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074760" or auth()->user()->school_code == "074543") {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074760')
                            ->orWhere('school_code', '074543');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074778" or auth()->user()->school_code == "074542") {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074778')
                            ->orWhere('school_code', '074542');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074313") {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074308") {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('school_code', auth()->user()->school_code)
                    ->orderBy('date')
                    ->get();
            }
        } else {
            if (auth()->user()->id == "215") {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->id == "216") {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $educator_propagandas = EducatorPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('user_id', auth()->user()->id)
                    ->orderBy('date')
                    ->get();
            }
        }
        $educator = "";
        foreach ($educator_propagandas as $educator_propaganda) {
            $educator .= $educator_propaganda->date . " " . $educator_propaganda->title . "(" . ($educator_propaganda->teacher_times + $educator_propaganda->student_times) . "人次)<w:br />";
            $j = 1;
            foreach ($educator_propaganda->pics as $pic) {
                $images[$i]['path'] = asset('storage/educator_propagandas/' . $educator_propaganda->id . '/' . $pic->pic);
                $images[$i]['file'] = storage_path('app/public/educator_propagandas/' . $educator_propaganda->id . '/' . $pic->pic);
                $images[$i]['desc'] = $educator_propaganda->date . $pic->pic_desc;
                $i++;
                $j++;
                if ($j == 3) break;
            }
        }
        $templateProcessor->setValue('educator', $educator);

        if (!empty(auth()->user()->school_code)) {
            if (auth()->user()->school_code == "074323" or auth()->user()->school_code == "074523") {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074323')
                            ->orWhere('school_code', '074523');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074328" or auth()->user()->school_code == "074528") {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074328')
                            ->orWhere('school_code', '074528');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074339" or auth()->user()->school_code == "074539") {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074339')
                            ->orWhere('school_code', '074539');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074745" or auth()->user()->school_code == "074537") {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074745')
                            ->orWhere('school_code', '074537');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074774" or auth()->user()->school_code == "074541") {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074774')
                            ->orWhere('school_code', '074541');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074760" or auth()->user()->school_code == "074543") {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074760')
                            ->orWhere('school_code', '074543');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074778" or auth()->user()->school_code == "074542") {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074778')
                            ->orWhere('school_code', '074542');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074313") {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074308") {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('school_code', auth()->user()->school_code)
                    ->orderBy('date')
                    ->get();
            }
        } else {
            if (auth()->user()->id == "215") {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->id == "216") {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $student_propagandas = StudentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('user_id', auth()->user()->id)
                    ->orderBy('date')
                    ->get();
            }
        }
        $student = "";
        foreach ($student_propagandas as $student_propaganda) {
            $student .= $student_propaganda->date . " " . $student_propaganda->title . "(" . ($student_propaganda->teacher_times + $student_propaganda->student_times) . "人次)<w:br />";
            $j = 1;
            foreach ($student_propaganda->pics as $pic) {
                $images[$i]['path'] = asset('storage/student_propagandas/' . $student_propaganda->id . '/' . $pic->pic);
                $images[$i]['file'] = storage_path('app/public/student_propagandas/' . $student_propaganda->id . '/' . $pic->pic);
                $images[$i]['desc'] = $student_propaganda->date . $pic->pic_desc;
                $i++;
                $j++;
                if ($j == 3) break;
            }
        }
        $templateProcessor->setValue('student', $student);


        //////////慈濟///////////
        if (!empty(auth()->user()->school_code)) {
            if (auth()->user()->school_code == "074323" or auth()->user()->school_code == "074523") {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074323')
                            ->orWhere('school_code', '074523');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074328" or auth()->user()->school_code == "074528") {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074328')
                            ->orWhere('school_code', '074528');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074339" or auth()->user()->school_code == "074539") {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074339')
                            ->orWhere('school_code', '074539');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074745" or auth()->user()->school_code == "074537") {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074745')
                            ->orWhere('school_code', '074537');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074774" or auth()->user()->school_code == "074541") {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074774')
                            ->orWhere('school_code', '074541');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074760" or auth()->user()->school_code == "074543") {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074760')
                            ->orWhere('school_code', '074543');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074778" or auth()->user()->school_code == "074542") {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074778')
                            ->orWhere('school_code', '074542');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074313") {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074308") {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('school_code', auth()->user()->school_code)
                    ->orderBy('date')
                    ->get();
            }
        } else {
            if (auth()->user()->id == "215") {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->id == "216") {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $tzuchi_propagandas = TzuchiPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('user_id', auth()->user()->id)
                    ->orderBy('date')
                    ->get();
            }
        }
        $tzuchi = "";
        foreach ($tzuchi_propagandas as $tzuchi_propaganda) {
            $tzuchi .= $tzuchi_propaganda->date . " " . $tzuchi_propaganda->title . "(" . ($tzuchi_propaganda->teacher_times + $tzuchi_propaganda->student_times) . "人次)<w:br />";
            $j = 1;
            foreach ($tzuchi_propaganda->pics as $pic) {
                $images[$i]['path'] = asset('storage/tzuchi_propagandas/' . $tzuchi_propaganda->id . '/' . $pic->pic);
                $images[$i]['file'] = storage_path('app/public/tzuchi_propagandas/' . $tzuchi_propaganda->id . '/' . $pic->pic);
                $images[$i]['desc'] = $tzuchi_propaganda->date . $pic->pic_desc;
                $i++;
                $j++;
                if ($j == 3) break;
            }
        }
        $templateProcessor->setValue('tzuchi', $tzuchi);

        /////////////////////

        if (!empty(auth()->user()->school_code)) {
            if (auth()->user()->school_code == "074323" or auth()->user()->school_code == "074523") {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074323')
                            ->orWhere('school_code', '074523');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074328" or auth()->user()->school_code == "074528") {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074328')
                            ->orWhere('school_code', '074528');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074339" or auth()->user()->school_code == "074539") {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074339')
                            ->orWhere('school_code', '074539');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074745" or auth()->user()->school_code == "074537") {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074745')
                            ->orWhere('school_code', '074537');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074774" or auth()->user()->school_code == "074541") {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074774')
                            ->orWhere('school_code', '074541');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074760" or auth()->user()->school_code == "074543") {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074760')
                            ->orWhere('school_code', '074543');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074778" or auth()->user()->school_code == "074542") {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074778')
                            ->orWhere('school_code', '074542');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074313") {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074308") {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('school_code', auth()->user()->school_code)
                    ->orderBy('date')
                    ->get();
            }
        } else {
            if (auth()->user()->id == "215") {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->id == "216") {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $parent_propagandas = ParentPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('user_id', auth()->user()->id)
                    ->orderBy('date')
                    ->get();
            }
        }
        $parent = "";
        foreach ($parent_propagandas as $parent_propaganda) {
            $parent .= $parent_propaganda->date . " " . $parent_propaganda->title . "(" . $parent_propaganda->person_times . "人次)<w:br />";
            $j = 1;
            foreach ($parent_propaganda->pics as $pic) {
                $images[$i]['path'] = asset('storage/parent_propagandas/' . $parent_propaganda->id . '/' . $pic->pic);
                $images[$i]['file'] = storage_path('app/public/parent_propagandas/' . $parent_propaganda->id . '/' . $pic->pic);
                $images[$i]['desc'] = $parent_propaganda->date . $pic->pic_desc;
                $i++;
                $j++;
                if ($j == 3) break;
            }
        }
        $templateProcessor->setValue('parent', $parent);

        if (!empty(auth()->user()->school_code)) {
            if (auth()->user()->school_code == "074323" or auth()->user()->school_code == "074523") {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074323')
                            ->orWhere('school_code', '074523');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074328" or auth()->user()->school_code == "074528") {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074328')
                            ->orWhere('school_code', '074528');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074339" or auth()->user()->school_code == "074539") {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074339')
                            ->orWhere('school_code', '074539');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074745" or auth()->user()->school_code == "074537") {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074745')
                            ->orWhere('school_code', '074537');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074774" or auth()->user()->school_code == "074541") {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074774')
                            ->orWhere('school_code', '074541');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074760" or auth()->user()->school_code == "074543") {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074760')
                            ->orWhere('school_code', '074543');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074778" or auth()->user()->school_code == "074542") {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074778')
                            ->orWhere('school_code', '074542');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074313") {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074308") {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('school_code', auth()->user()->school_code)
                    ->orderBy('date')
                    ->get();
            }
        } else {
            if (auth()->user()->id == "215") {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->id == "216") {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $telephone_propagandas = TelephonePropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('user_id', auth()->user()->id)
                    ->orderBy('date')
                    ->get();
            }
        }
        $telephone = "";
        foreach ($telephone_propagandas as $telephone_propaganda) {
            $telephone .= $telephone_propaganda->date . " " . $telephone_propaganda->title . "(" . $telephone_propaganda->person_times . "人次)<w:br />";
            $j = 1;
            foreach ($telephone_propaganda->pics as $pic) {
                $images[$i]['path'] = asset('storage/telephone_propagandas/' . $telephone_propaganda->id . '/' . $pic->pic);
                $images[$i]['file'] = storage_path('app/public/telephone_propagandas/' . $telephone_propaganda->id . '/' . $pic->pic);
                $images[$i]['desc'] = $telephone_propaganda->date . $pic->pic_desc;
                $i++;
                $j++;
                if ($j == 3) break;
            }
        }
        $templateProcessor->setValue('telephone', $telephone);
        ///////////其他////////////
        if (!empty(auth()->user()->school_code)) {
            if (auth()->user()->school_code == "074323" or auth()->user()->school_code == "074523") {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074323')
                            ->orWhere('school_code', '074523');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074328" or auth()->user()->school_code == "074528") {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074328')
                            ->orWhere('school_code', '074528');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074339" or auth()->user()->school_code == "074539") {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074339')
                            ->orWhere('school_code', '074539');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074745" or auth()->user()->school_code == "074537") {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074745')
                            ->orWhere('school_code', '074537');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074774" or auth()->user()->school_code == "074541") {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074774')
                            ->orWhere('school_code', '074541');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074760" or auth()->user()->school_code == "074543") {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074760')
                            ->orWhere('school_code', '074543');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074778" or auth()->user()->school_code == "074542") {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074778')
                            ->orWhere('school_code', '074542');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074313") {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->school_code == "074308") {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('school_code', auth()->user()->school_code)
                    ->orderBy('date')
                    ->get();
            }
        } else {
            if (auth()->user()->id == "215") {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074313')
                            ->orWhere('user_id', '215');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } elseif (auth()->user()->id == "216") {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where(function ($query) {
                        $query->where('school_code', '074308')
                            ->orWhere('user_id', '216');
                    })
                    ->orderBy('date', 'DESC')
                    ->get();
            } else {
                $other_propagandas = OtherPropaganda::where('date', '>=', $date1)
                    ->where('date', '<=', $date2)
                    ->where('user_id', auth()->user()->id)
                    ->orderBy('date')
                    ->get();
            }
        }
        $other = "";
        foreach ($other_propagandas as $other_propaganda) {
            $other .= $other_propaganda->date . " " . $other_propaganda->title . "(" . $other_propaganda->person_times . "人次)<w:br />";
            $j = 1;
            foreach ($other_propaganda->pics as $pic) {
                $images[$i]['path'] = asset('storage/other_propagandas/' . $other_propaganda->id . '/' . $pic->pic);
                $images[$i]['file'] = storage_path('app/public/other_propagandas/' . $other_propaganda->id . '/' . $pic->pic);
                $images[$i]['desc'] = $other_propaganda->date . $pic->pic_desc;
                $i++;
                $j++;
                if ($j == 3) break;
            }
        }
        $templateProcessor->setValue('other', $other);

        //////////////////////////
        foreach ($images as $k => $v) {
            if (file_exists($v['file'])) {
                $photo = str_replace(' ', '%20', $v['path']);
                $templateProcessor->setImageValue('photo' . $k, array('path' => $photo, 'width' => 350, 'height' => 200, 'ratio' => true));
            }
            $templateProcessor->setValue('desc' . $k, $v['desc']);
            if ($i == 30) break;
        }



        $templateProcessor->saveAs(storage_path('app/public/' . $filename));


        header("Content-Disposition: attachment; filename={$filename}");
        readfile(storage_path('app/public/' . $filename)); // or echo file_get_contents($temp_file);
        unlink(storage_path('app/public/' . $filename));  // remove temp file
    }
}
