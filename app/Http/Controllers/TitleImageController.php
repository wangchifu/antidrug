<?php

namespace App\Http\Controllers;

use App\Models\TitleImage;
use Illuminate\Http\Request;

class TitleImageController extends Controller
{
    public function index()
    {
        $title_images = TitleImage::all();
        $path = storage_path('app/public/title_image');
        if(!is_dir($path)) mkdir($path);

        $data = [
            'title_images'=>$title_images,
        ];
        return view('title_images.index',$data);
    }

    public function store(Request $request)
    {
        $att = $request->all();

        $path = storage_path('app/public/title_images');

        if(!is_dir($path)) mkdir($path);

        //處理檔案上傳
        if ($request->hasFile('pic')) {
            $pic = $request->file('pic');
            $info = [
                'original_filename' => $pic->getClientOriginalName(),
                'extension' => $pic->getClientOriginalExtension(),
            ];
            $name = date('YmdHis');
            $pic->storeAs('public/title_images', $name.'.'.$info['extension']);
            $att['photo_name'] = $name.'.'.$info['extension'];

            TitleImage::create($att);
        }
        return redirect()->route('title_images.index');
    }

    public function edit(TitleImage $title_image)
    {
        $data = [
            'title_image'=>$title_image,
        ];
        return view('title_images.edit',$data);
    }

    public function update(Request $request,TitleImage $title_image)
    {
        $att = $request->all();
        $title_image->update($att);
        return redirect()->route('title_images.index');
    }

    public function destroy(TitleImage $title_image)
    {
        if(file_exists(storage_path('app/public/title_images/'.$title_image->photo_name))){
            unlink(storage_path('app/public/title_images/'.$title_image->photo_name));
        }
        $title_image->delete();
        return redirect()->route('title_images.index');
    }
}
