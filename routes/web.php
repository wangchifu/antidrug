<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BoeActiveController;
use App\Http\Controllers\CenterActiveController;
use App\Http\Controllers\EducatorPropagandaController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\MonthlyPropagandaController;
use App\Http\Controllers\ParentPropagandaController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\StudentPropagandaController;
use App\Http\Controllers\TelephonePropagandaController;
use App\Http\Controllers\TitleImageController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UrineScreenBookController;
use App\Http\Controllers\UrineScreenWorkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResultController;



Route::get('/', [HomeController::class,'index'])->name('index');

//首頁

//下載storage裡public的檔案
Route::get('file/{file}', [FileController::class,'getFile']);


//gsuite登入
Route::get('login', [GLoginController::class,'login'])->name('login');
Route::post('glogin', [GLoginController::class,'auth'])->name('gauth');

#登出
Route::get('logout', [GLoginController::class,'logout'])->name('logout');

Route::get('web/posts', [PostController::class,'index'])->name('posts.index');
Route::get('web/posts/show/{post}', [PostController::class,'show'])->name('posts.show');

//認證圖片
Route::get('pic/{d?}', [HomeController::class,'pic'])->name('pic');

Route::get('web/articles/{article}/show', [ArticleController::class,'show'])->name('articles.show');

Route::get('web/uploads/index/{path?}' , [UploadController::class,'index'])->name('uploads.index');
Route::get('web/uploads/{path}/download' , [UploadController::class,'download'])->name('uploads.download');

Route::get('propaganda/{propaganda_type?}', [HomeController::class,'propaganda'])->name('propagandas.propaganda');

Route::get('upload1/monthly_propaganda/{monthly_propaganda}/show', [MonthlyPropagandaController::class,'show'])->name('monthly_propagandas.show');
Route::get('upload1/educator_propaganda/{educator_propaganda}/show', [EducatorPropagandaController::class,'show'])->name('educator_propagandas.show');
Route::get('upload1/student_propaganda/{student_propaganda}/show', [StudentPropagandaController::class,'show'])->name('student_propagandas.show');
Route::get('upload1/parent_propaganda/{parent_propaganda}/show', [ParentPropagandaController::class,'show'])->name('parent_propagandas.show');
Route::get('upload1/telephone_propaganda/{telephone_propaganda}/show', [TelephonePropagandaController::class,'show'])->name('telephone_propagandas.show');

Route::get('upload2/boe_active/{boe_active}/show', [BoeActiveController::class,'show'])->name('boe_actives.show');
Route::get('upload2/center_active/{center_active}/show', [CenterActiveController::class,'show'])->name('center_actives.show');

Route::get('upload1/monthly_propaganda/{monthly_propaganda}/print', [MonthlyPropagandaController::class,'print'])->name('monthly_propagandas.print');
Route::get('upload1/educator_propaganda/{educator_propaganda}/print', [EducatorPropagandaController::class,'print'])->name('educator_propagandas.print');
Route::get('upload1/student_propaganda/{student_propaganda}/print', [StudentPropagandaController::class,'print'])->name('student_propagandas.print');
Route::get('upload1/parent_propaganda/{parent_propaganda}/print', [ParentPropagandaController::class,'print'])->name('parent_propagandas.print');
Route::get('upload1/telephone_propaganda/{telephone_propaganda}/print', [TelephonePropagandaController::class,'print'])->name('telephone_propagandas.print');

Route::get('upload2/boe_active/{boe_active}/print', [BoeActiveController::class,'print'])->name('boe_actives.print');
Route::get('upload2/center_active/{center_active}/print', [CenterActiveController::class,'print'])->name('center_actives.print');

Route::group(['middleware' => 'auth'],function() {
//結束模擬
    Route::get('sims/impersonate_leave', [SimulationController::class,'impersonate_leave'])->name('sims.impersonate_leave');

    Route::get('users/reset_pwd', [HomeController::class,'reset_pwd'])->name('reset_pwd');
    Route::patch('users/update_pwd', [HomeController::class,'update_pwd'])->name('update_pwd');

    //年度計畫
    Route::get('upload1/plans', [PlanController::class,'index'])->name('plans.index');
    Route::get('upload1/plans/submit/{plan}', [PlanController::class,'submit'])->name('plans.submit');
    Route::post('upload1/plans/store', [PlanController::class,'store'])->name('plans.store');
    Route::get('upload1/plans/destroy/{plan}', [PlanController::class,'destroy'])->name('plans.destroy');

    //每月反毒
    Route::get('upload1/monthly_propaganda', [MonthlyPropagandaController::class,'index'])->name('monthly_propagandas.index');
    Route::get('upload1/monthly_propaganda/create', [MonthlyPropagandaController::class,'create'])->name('monthly_propagandas.create');
    Route::get('upload1/monthly_propaganda/{monthly_propaganda}/edit', [MonthlyPropagandaController::class,'edit'])->name('monthly_propagandas.edit');
    Route::post('upload1/monthly_propaganda/store', [MonthlyPropagandaController::class,'store'])->name('monthly_propagandas.store');
    Route::post('upload1/monthly_propaganda/{monthly_propaganda}/update', [MonthlyPropagandaController::class,'update'])->name('monthly_propagandas.update');
    Route::get('upload1/monthly_propaganda/{monthly_propaganda_pic}/del_pic', [MonthlyPropagandaController::class,'del_pic'])->name('monthly_propagandas.del_pic');
    Route::get('upload1/monthly_propaganda/{monthly_propaganda}/destroy', [MonthlyPropagandaController::class,'destroy'])->name('monthly_propagandas.destroy');

    Route::get('upload1/educator_propaganda', [EducatorPropagandaController::class,'index'])->name('educator_propagandas.index');
    Route::get('upload1/educator_propaganda/create', [EducatorPropagandaController::class,'create'])->name('educator_propagandas.create');
    Route::get('upload1/educator_propaganda/{educator_propaganda}/edit', [EducatorPropagandaController::class,'edit'])->name('educator_propagandas.edit');
    Route::post('upload1/educator_propaganda/store', [EducatorPropagandaController::class,'store'])->name('educator_propagandas.store');
    Route::post('upload1/educator_propaganda/{educator_propaganda}/update', [EducatorPropagandaController::class,'update'])->name('educator_propagandas.update');
    Route::get('upload1/educator_propaganda/{educator_propaganda_pic}/del_pic', [EducatorPropagandaController::class,'del_pic'])->name('educator_propagandas.del_pic');
    Route::get('upload1/educator_propaganda/{educator_propaganda}/destroy', [EducatorPropagandaController::class,'destroy'])->name('educator_propagandas.destroy');

    Route::get('upload1/student_propaganda', [StudentPropagandaController::class,'index'])->name('student_propagandas.index');
    Route::get('upload1/student_propaganda/create', [StudentPropagandaController::class,'create'])->name('student_propagandas.create');
    Route::get('upload1/student_propaganda/{student_propaganda}/edit', [StudentPropagandaController::class,'edit'])->name('student_propagandas.edit');
    Route::post('upload1/student_propaganda/store', [StudentPropagandaController::class,'store'])->name('student_propagandas.store');
    Route::post('upload1/student_propaganda/{student_propaganda}/update', [StudentPropagandaController::class,'update'])->name('student_propagandas.update');
    Route::get('upload1/student_propaganda/{student_propaganda_pic}/del_pic', [StudentPropagandaController::class,'del_pic'])->name('student_propagandas.del_pic');
    Route::get('upload1/student_propaganda/{student_propaganda}/destroy', [StudentPropagandaController::class,'destroy'])->name('student_propagandas.destroy');

    Route::get('upload1/parent_propaganda', [ParentPropagandaController::class,'index'])->name('parent_propagandas.index');
    Route::get('upload1/parent_propaganda/create', [ParentPropagandaController::class,'create'])->name('parent_propagandas.create');
    Route::get('upload1/parent_propaganda/{parent_propaganda}/edit', [ParentPropagandaController::class,'edit'])->name('parent_propagandas.edit');
    Route::post('upload1/parent_propaganda/store', [ParentPropagandaController::class,'store'])->name('parent_propagandas.store');
    Route::post('upload1/parent_propaganda/{parent_propaganda}/update', [ParentPropagandaController::class,'update'])->name('parent_propagandas.update');
    Route::get('upload1/parent_propaganda/{parent_propaganda_pic}/del_pic', [ParentPropagandaController::class,'del_pic'])->name('parent_propagandas.del_pic');
    Route::get('upload1/parent_propaganda/{parent_propaganda}/destroy', [ParentPropagandaController::class,'destroy'])->name('parent_propagandas.destroy');

    Route::get('upload1/telephone_propaganda', [TelephonePropagandaController::class,'index'])->name('telephone_propagandas.index');
    Route::get('upload1/telephone_propaganda/create', [TelephonePropagandaController::class,'create'])->name('telephone_propagandas.create');
    Route::get('upload1/telephone_propaganda/{telephone_propaganda}/edit', [TelephonePropagandaController::class,'edit'])->name('telephone_propagandas.edit');
    Route::post('upload1/telephone_propaganda/store', [TelephonePropagandaController::class,'store'])->name('telephone_propagandas.store');
    Route::post('upload1/telephone_propaganda/{telephone_propaganda}/update', [TelephonePropagandaController::class,'update'])->name('telephone_propagandas.update');
    Route::get('upload1/telephone_propaganda/{telephone_propaganda_pic}/del_pic', [TelephonePropagandaController::class,'del_pic'])->name('telephone_propagandas.del_pic');
    Route::get('upload1/telephone_propaganda/{telephone_propaganda}/destroy', [TelephonePropagandaController::class,'destroy'])->name('telephone_propagandas.destroy');

    Route::get('upload2/boe_active', [BoeActiveController::class,'index'])->name('boe_actives.index');
    Route::get('upload2/boe_active/create', [BoeActiveController::class,'create'])->name('boe_actives.create');
    Route::get('upload2/boe_active/{boe_active}/edit', [BoeActiveController::class,'edit'])->name('boe_actives.edit');
    Route::post('upload2/boe_active/store', [BoeActiveController::class,'store'])->name('boe_actives.store');
    Route::post('upload2/boe_active/{boe_active}/update', [BoeActiveController::class,'update'])->name('boe_actives.update');
    Route::get('upload2/boe_active/{boe_active_pic}/del_pic', [BoeActiveController::class,'del_pic'])->name('boe_actives.del_pic');
    Route::get('upload2/boe_active/{boe_active}/destroy', [BoeActiveController::class,'destroy'])->name('boe_actives.destroy');

    Route::get('upload2/center_active', [CenterActiveController::class,'index'])->name('center_actives.index');
    Route::get('upload2/center_active/create', [CenterActiveController::class,'create'])->name('center_actives.create');
    Route::get('upload2/center_active/{center_active}/edit', [CenterActiveController::class,'edit'])->name('center_actives.edit');
    Route::post('upload2/center_active/store', [CenterActiveController::class,'store'])->name('center_actives.store');
    Route::post('upload2/center_active/{center_active}/update', [CenterActiveController::class,'update'])->name('center_actives.update');
    Route::get('upload2/center_active/{center_active_pic}/del_pic', [CenterActiveController::class,'del_pic'])->name('center_actives.del_pic');
    Route::get('upload2/center_active/{center_active}/destroy', [CenterActiveController::class,'destroy'])->name('center_actives.destroy');

    Route::get('upload3/urine_screen_book', [UrineScreenBookController::class,'index'])->name('urine_screen_books.index');
    Route::get('upload3/urine_screen_book/create', [UrineScreenBookController::class,'create'])->name('urine_screen_books.create');
    Route::get('upload3/urine_screen_book/{urine_screen_book}/show', [UrineScreenBookController::class,'show'])->name('urine_screen_books.show');
    Route::get('upload3/urine_screen_book/{urine_screen_book}/edit', [UrineScreenBookController::class,'edit'])->name('urine_screen_books.edit');
    Route::post('upload3/urine_screen_book/store', [UrineScreenBookController::class,'store'])->name('urine_screen_books.store');
    Route::post('upload3/urine_screen_book/{urine_screen_book}/update', [UrineScreenBookController::class,'update'])->name('urine_screen_books.update');
    Route::get('upload2/urine_screen_book/{urine_screen_book}/destroy', [UrineScreenBookController::class,'destroy'])->name('urine_screen_books.destroy');

    Route::get('upload3/urine_screen_work', [UrineScreenWorkController::class,'index'])->name('urine_screen_works.index');
    Route::get('upload3/urine_screen_work/{urine_screen_work}/open', [UrineScreenWorkController::class,'open'])->name('urine_screen_works.open');
    Route::get('upload3/urine_screen_work/create', [UrineScreenWorkController::class,'create'])->name('urine_screen_works.create');
    Route::get('upload3/urine_screen_work/{urine_screen_work}/agree', [UrineScreenWorkController::class,'agree'])->name('urine_screen_works.agree');
    Route::post('upload3/urine_screen_work/store_member', [UrineScreenWorkController::class,'store_member'])->name('urine_screen_works.store_member');
    Route::post('upload3/urine_screen_work/import_member', [UrineScreenWorkController::class,'import_member'])->name('urine_screen_works.import_member');
    Route::get('upload3/urine_screen_work/{urine_screen_work_member}/delete_member', [UrineScreenWorkController::class,'delete_member'])->name('urine_screen_works.delete_member');
    Route::get('upload3/urine_screen_work/{urine_screen_work}/show', [UrineScreenWorkController::class,'show'])->name('urine_screen_works.show');
    Route::get('upload3/urine_screen_work/{urine_screen_work}/edit', [UrineScreenWorkController::class,'edit'])->name('urine_screen_works.edit');
    Route::post('upload3/urine_screen_work/store', [UrineScreenWorkController::class,'store'])->name('urine_screen_works.store');
    Route::post('upload3/urine_screen_work/{urine_screen_work}/update', [UrineScreenWorkController::class,'update'])->name('urine_screen_works.update');
    Route::get('upload2/urine_screen_work/{urine_screen_work}/destroy', [UrineScreenWorkController::class,'destroy'])->name('urine_screen_works.destroy');

    Route::get('upload3/special', [SpecialController::class,'index'])->name('specials.index');
    Route::get('upload3/special/{id}/{action}/open', [SpecialController::class,'open'])->name('specials.open');
    Route::get('upload3/special/create', [SpecialController::class,'create'])->name('specials.create');
    Route::get('upload3/special/{special}/show', [SpecialController::class,'show'])->name('specials.show');
    Route::get('upload3/special/{special}/edit', [SpecialController::class,'edit'])->name('specials.edit');
    Route::post('upload3/special/store', [SpecialController::class,'store'])->name('specials.store');
    Route::get('upload3/special/{special}/agree', [SpecialController::class,'agree'])->name('specials.agree');
    Route::post('upload3/special/store_member', [SpecialController::class,'store_member'])->name('specials.store_member');
    Route::get('upload3/special/{special_member}/delete_member', [SpecialController::class,'delete_member'])->name('specials.delete_member');
    Route::get('upload3/special/{special}/reagent', [SpecialController::class,'reagent'])->name('specials.reagent');
    Route::post('upload3/special/store_reagent', [SpecialController::class,'store_reagent'])->name('specials.store_reagent');
    Route::get('upload3/special/{special_reagent}/delete_reagent', [SpecialController::class,'delete_reagent'])->name('specials.delete_reagent');
    Route::post('upload3/special/{special}/update', [SpecialController::class,'update'])->name('specials.update');
    Route::get('upload2/special/{special}/destroy', [SpecialController::class,'destroy'])->name('specials.destroy');

    Route::get('result/year_result/{year?}', [ResultController::class,'year_result'])->name('year_result');
    Route::get('result/year_result_download/{year}', [ResultController::class,'year_result_download'])->name('year_result_download');
});

Route::group(['middleware' => 'admin'],function(){
    Route::get('setup/index', [SetupController::class,'setup'])->name('setups.index');
    Route::post('setup/{setup}/update', [SetupController::class,'setup_update'])->name('setups.update');

    //模擬登入
    Route::get('sims/{user}/impersonate', [SimulationController::class,'impersonate'])->name('sims.impersonate');

    Route::get('users', [UserController::class,'index'])->name('users.index');
    Route::post('users/search', [UserController::class,'search'])->name('users.search');

    Route::get('users/create', [UserController::class,'create'])->name('users.create');
    Route::post('users/store', [UserController::class,'store'])->name('users.store');
    Route::get('users/edit/{user}', [UserController::class,'edit'])->name('users.edit');
    Route::post('users/update/{user}', [UserController::class,'update'])->name('users.update');
    Route::get('users/disable/{user}', [UserController::class,'disable'])->name('users.disable');
    Route::get('users/reset_pwd/{user}', [UserController::class,'reset_pwd'])->name('users.reset_pwd');

    Route::get('web/posts/create', [PostController::class,'create'])->name('posts.create');
    Route::post('web/posts/store', [PostController::class,'store'])->name('posts.store');
    Route::get('web/posts/edit/{post}', [PostController::class,'edit'])->name('posts.edit');
    Route::get('web/posts/del_file/{file}/{id}', [PostController::class,'del_file'])->name('posts.del_file');
    Route::post('web/posts/update/{post}', [PostController::class,'update'])->name('posts.update');
    Route::get('web/posts/destroy/{post}', [PostController::class,'destroy'])->name('posts.destroy');

    Route::get('web/title_images', [TitleImageController::class,'index'])->name('title_images.index');
    Route::post('web/title_images/store', [TitleImageController::class,'store'])->name('title_images.store');
    Route::get('web/title_images/{title_image}/edit', [TitleImageController::class,'edit'])->name('title_images.edit');
    Route::post('web/title_images/{title_image}/update', [TitleImageController::class,'update'])->name('title_images.update');
    Route::get('web/title_images/{title_image}/destroy', [TitleImageController::class,'destroy'])->name('title_images.destroy');

    Route::get('web/links', [LinkController::class,'index'])->name('links.index');
    Route::post('web/links/store', [LinkController::class,'store'])->name('links.store');
    Route::get('web/links/{link}/edit', [LinkController::class,'edit'])->name('links.edit');
    Route::post('web/links/{link}/update', [LinkController::class,'update'])->name('links.update');
    Route::get('web/links/{link}/destroy', [LinkController::class,'destroy'])->name('links.destroy');

    Route::get('web/articles', [ArticleController::class,'index'])->name('articles.index');
    Route::get('web/articles/create', [ArticleController::class,'create'])->name('articles.create');
    Route::post('web/articles/store', [ArticleController::class,'store'])->name('articles.store');
    Route::get('web/articles/{article}/edit', [ArticleController::class,'edit'])->name('articles.edit');
    Route::post('web/articles/{article}/update', [ArticleController::class,'update'])->name('articles.update');
    Route::get('web/articles/{article}/destroy', [ArticleController::class,'destroy'])->name('articles.destroy');

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    //公開文件
    Route::post('web/uploads/create_folder' , [UploadController::class,'create_folder'])->name('uploads.create_folder');
    Route::post('web/uploads/upload_file' , [UploadController::class,'upload_file'])->name('uploads.upload_file');
    Route::get('web/uploads/{path}/delete' , [UploadController::class,'delete'])->name('uploads.delete');


    //年度計畫
    Route::get('review1/plans/{year?}', [PlanController::class,'review'])->name('plans.review');
    Route::post('review1/plans/search', [PlanController::class,'search'])->name('plans.search');
    Route::get('review1/plans/statistics/{year?}', [PlanController::class,'statistics'])->name('plans.statistics');
    Route::get('review1/plans/ok/{year}/{plan}/{page}', [PlanController::class,'ok'])->name('plans.ok');
    Route::post('review1/plans/back/{plan}', [PlanController::class,'back'])->name('plans.back');

    Route::get('review1/monthly_propaganda/review/{date1?}/{date2?}', [MonthlyPropagandaController::class,'review'])->name('monthly_propagandas.review');
    Route::post('review1/monthly_propaganda/search', [MonthlyPropagandaController::class,'search'])->name('monthly_propagandas.search');
    Route::get('review1/monthly_propaganda/statistics/{date1}/{date2}', [MonthlyPropagandaController::class,'statistics'])->name('monthly_propagandas.statistics');

    Route::get('review1/educator_propaganda/review/{date1?}/{date2?}', [EducatorPropagandaController::class,'review'])->name('educator_propagandas.review');
    Route::post('review1/educator_propaganda/search', [EducatorPropagandaController::class,'search'])->name('educator_propagandas.search');
    Route::get('review1/educator_propaganda/statistics/{date1}/{date2}', [EducatorPropagandaController::class,'statistics'])->name('educator_propagandas.statistics');

    Route::get('review1/student_propaganda/review/{date1?}/{date2?}', [StudentPropagandaController::class,'review'])->name('student_propagandas.review');
    Route::post('review1/student_propaganda/search', [StudentPropagandaController::class,'search'])->name('student_propagandas.search');
    Route::get('review1/student_propaganda/statistics/{date1}/{date2}', [StudentPropagandaController::class,'statistics'])->name('student_propagandas.statistics');

    Route::get('review1/parent_propaganda/review/{date1?}/{date2?}', [ParentPropagandaController::class,'review'])->name('parent_propagandas.review');
    Route::post('review1/parent_propaganda/search', [ParentPropagandaController::class,'search'])->name('parent_propagandas.search');
    Route::get('review1/parent_propaganda/statistics/{date1}/{date2}', [ParentPropagandaController::class,'statistics'])->name('parent_propagandas.statistics');

    Route::get('review1/telephone_propaganda/review/{date1?}/{date2?}', [TelephonePropagandaController::class,'review'])->name('telephone_propagandas.review');
    Route::post('review1/telephone_propaganda/search', [TelephonePropagandaController::class,'search'])->name('telephone_propagandas.search');
    Route::get('review1/telephone_propaganda/statistics/{date1}/{date2}', [TelephonePropagandaController::class,'statistics'])->name('telephone_propagandas.statistics');

    Route::get('review2/boe_active/review/{date1?}/{date2?}', [BoeActiveController::class,'review'])->name('boe_actives.review');
    Route::post('review2/boe_active/search', [BoeActiveController::class,'search'])->name('boe_actives.search');
    Route::get('review2/boe_active/statistics/{date1}/{date2}', [BoeActiveController::class,'statistics'])->name('boe_actives.statistics');

    Route::get('review2/center_active/review/{date1?}/{date2?}', [CenterActiveController::class,'review'])->name('center_actives.review');
    Route::post('review2/center_active/search', [CenterActiveController::class,'search'])->name('center_actives.search');
    Route::get('review2/center_active/statistics/{date1}/{date2}', [CenterActiveController::class,'statistics'])->name('center_actives.statistics');

    Route::get('review3/special/review/{date1?}/{date2?}', [SpecialController::class,'review'])->name('specials.review');
    Route::get('review3/special/{special}/review_book', [SpecialController::class,'review_book'])->name('specials.review_book');
    Route::post('review3/special/search', [SpecialController::class,'search'])->name('specials.search');
    Route::get('review3/special/statistics/{date1}/{date2}', [SpecialController::class,'statistics'])->name('specials.statistics');

    Route::get('review3/urine_screen_book/review/{date1?}/{date2?}', [UrineScreenBookController::class,'review'])->name('urine_screen_books.review');
    Route::post('review3/urine_screen_book/search', [UrineScreenBookController::class,'search'])->name('urine_screen_books.search');
    Route::get('review3/urine_screen_book/statistics/{date1}/{date2}', [UrineScreenBookController::class,'statistics'])->name('urine_screen_books.statistics');

    Route::get('review3/urine_screen_work/review/{date1?}/{date2?}', [UrineScreenWorkController::class,'review'])->name('urine_screen_works.review');
    Route::get('review3/urine_screen_work/{urine_screen_work}/review_book', [UrineScreenWorkController::class,'review_book'])->name('urine_screen_works.review_book');
    Route::post('review3/urine_screen_work/search', [UrineScreenWorkController::class,'search'])->name('urine_screen_works.search');
    Route::get('review3/urine_screen_work/statistics/{date1}/{date2}', [UrineScreenWorkController::class,'statistics'])->name('urine_screen_works.statistics');
});
