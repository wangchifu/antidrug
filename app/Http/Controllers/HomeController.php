<?php

namespace App\Http\Controllers;

use App\Models\BoeActive;
use App\Models\CenterActive;
use App\Models\EducatorPropaganda;
use App\Models\MonthlyPropaganda;
use App\Models\MonthlyPropagandaPic;
use App\Models\ParentPropaganda;
use App\Models\StudentPropaganda;
use App\Models\TzuchiPropaganda;
use App\Models\TelephonePropaganda;
use App\Models\TitleImage;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(5);
        $title_images = TitleImage::all();

        //$monthly_propagandas = MonthlyPropaganda::orderBy('id', 'DESC')
        //->paginate(10);

        $educator_propagandas = EducatorPropaganda::orderBy('id', 'DESC')
            ->paginate(3);
        $student_propagandas = StudentPropaganda::orderBy('id', 'DESC')
            ->paginate(3);
        $tzuchi_propagandas = TzuchiPropaganda::orderBy('id', 'DESC')
            ->paginate(3);
        $parent_propagandas = ParentPropaganda::orderBy('id', 'DESC')
            ->paginate(3);
        $telephone_propagandas = TelephonePropaganda::orderBy('id', 'DESC')
            ->paginate(10);
        $boe_actives = BoeActive::orderBy('id', 'DESC')
            ->paginate(3);
        $center_actives = CenterActive::orderBy('id', 'DESC')
            ->paginate(3);

        $data = [
            'posts' => $posts,
            'title_images' => $title_images,
            //'monthly_propagandas' => $monthly_propagandas,
            'educator_propagandas' => $educator_propagandas,
            'student_propagandas' => $student_propagandas,
            'tzuchi_propagandas' => $tzuchi_propagandas,
            'parent_propagandas' => $parent_propagandas,
            'telephone_propagandas' => $telephone_propagandas,
            'boe_actives' => $boe_actives,
            'center_actives' => $center_actives,
        ];
        return view('index', $data);
    }

    public function pic($d = null)
    {

        if (empty($d)) {
            $key = rand(10000, 99999);
        } else {
            $key = substr($d, 0, 5);
        }
        $back = rand(0, 9);
        /*
        $r = rand(0,255);
        $g = rand(0,255);
        $b = rand(0,255);
        */
        $r = 0;
        $g = 0;
        $b = 0;

        session(['chaptcha' => $key]);

        //$cht = array(0=>"零",1=>"壹",2=>"貳",3=>"參",4=>"肆",5=>"伍",6=>"陸",7=>"柒",8=>"捌",9=>"玖");
        $cht = array(0 => "0", 1 => "1", 2 => "2", 3 => "3", 4 => "4", 5 => "5", 6 => "6", 7 => "7", 8 => "8", 9 => "9");
        $cht_key = "";
        for ($i = 0; $i < 5; $i++) $cht_key .= $cht[substr($key, $i, 1)];

        header("Content-type: image/gif");
        $im = imagecreatefromgif(asset('images/back/01.gif')) or die("無法建立GD圖片");
        $text_color = imagecolorallocate($im, $r, $g, $b);

        imagettftext($im, 25, 0, 5, 32, $text_color, public_path('font/AdobeGothicStd-Bold.otf'), $cht_key);
        imagegif($im);
        imagedestroy($im);
    }


    public function admin()
    {
        return view('admin');
    }

    public function reset_pwd()
    {
        return view('reset_pwd');
    }

    public function update_pwd(Request $request)
    {
        $request->validate([
            'password1' => 'required|same:password2'
        ]);
        if (password_verify($request->input('password0'), auth()->user()->password)) {
            $att['password'] = bcrypt($request->input('password1'));
            User::where('id', auth()->user()->id)->update($att);
            return redirect()->route('index');
        } else {
            return back()->withErrors('舊密碼錯誤');
        }

        return redirect()->route('index');
    }

    public function propaganda($propaganda_type = null)
    {
        $schools = config('antidrug.schools');

        /**取消每日上傳
        $propaganda_type = (empty($propaganda_type)) ? "monthly_propagandas" : $propaganda_type;
        }
         */
        $propaganda_type = (empty($propaganda_type)) ? "educator_propagandas" : $propaganda_type;

        if ($propaganda_type == "monthly_propagandas") {
            $propagandas = MonthlyPropaganda::orderBy('date', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }
        if ($propaganda_type == "educator_propagandas") {
            $propagandas = EducatorPropaganda::orderBy('date', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }
        if ($propaganda_type == "student_propagandas") {
            $propagandas = StudentPropaganda::orderBy('date', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }
        if ($propaganda_type == "parent_propagandas") {
            $propagandas = ParentPropaganda::orderBy('date', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }
        if ($propaganda_type == "telephone_propagandas") {
            $propagandas = TelephonePropaganda::orderBy('date', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }
        if ($propaganda_type == "tzuchi_propagandas") {
            $propagandas = TzuchiPropaganda::orderBy('date', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }
        if ($propaganda_type == "boe_actives") {
            $propagandas = BoeActive::orderBy('date', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }
        if ($propaganda_type == "center_actives") {
            $propagandas = CenterActive::orderBy('date', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }


        $types = [
            'educator_propagandas' => '教職宣導',
            'student_propagandas' => '學生宣導',
            'parent_propagandas' => '家長宣導',
            'telephone_propagandas' => '戒毒成功專線宣導',
            'tzuchi_propagandas' => '慈濟無毒有我宣導',
            'boe_actives' => '教育處自辦活動',
            'center_actives' => '中心學校成果',
            'monthly_propagandas' => '每月宣導(已停更)',
        ];

        $data = [
            'schools' => $schools,
            'propaganda_type' => $propaganda_type,
            'types' => $types,
            'propagandas' => $propagandas,
        ];
        return view('propaganda', $data);
    }
}
