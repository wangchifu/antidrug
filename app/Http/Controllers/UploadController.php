<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index($path=null)
    {
        $folder_path[0] = '根目錄';

        $path_array = explode('&',$path);
        $folder_id = end($path_array);
        if(empty($folder_id)) $folder_id=null;

        foreach($path_array as $v){
            if($v != null){
                $check = Upload::where('id',$v)->first();
                $folder_path[$v] = $check->name;
            }
        }

        //列出目錄
        $folders = Upload::where('type','1')
            ->where('folder_id',$folder_id)
            ->orderBy('name')
            ->get();

        //列出檔案
        $files = Upload::where('type','2')
            ->where('folder_id',$folder_id)
            ->orderBy('name')
            ->get();


        $data = [
            'path'=>$path,
            'folder_id'=>$folder_id,
            'folders'=>$folders,
            'folder_path'=>$folder_path,
            'files'=>$files,
        ];
        return view('uploads.index',$data);
    }

    public function create_folder(Request $request)
    {
        if (strpos ($request->input('name'), "&")){
            return back()->withErrors(['error'=>['不得有特殊字元「&」！']]);
        }
        if (strpos ($request->input('name'), "\"")){
            return back()->withErrors(['error'=>['不得有特殊字元「"」！']]);
        }
        if (strpos ($request->input('name'), "'")){
            return back()->withErrors(['error'=>["不得有特殊字元「'」！"]]);
        }

        $root = storage_path('app/public/uploads');

        if(!is_dir($root)){
            mkdir($root);
        }
        //新增目錄
        $new_path = $root;

        foreach(explode('&',$request->input('path')) as $v){
            $check = Upload::where('id',$v)->first();
            if(!empty($v)) $new_path .= '/'.$check->name;
        }

        $new_path .= '/'.$request->input('name');

        $att['name'] = $request->input('name');
        $att['type'] = 1;//目錄
        $att['user_id'] = auth()->user()->id;
        $att['folder_id'] = $request->input('folder_id');


        if(!is_dir($new_path)){
            mkdir($new_path);
            Upload::create($att);
        }else{
            return back()->withErrors(['error'=>['已有此目錄！']]);
        }
        return redirect()->route('uploads.index',$request->input('path'));
    }

    public function upload_file(Request $request)
    {
        $root = storage_path('app/public/uploads');
        $p = 'public/uploads';
        if(!is_dir($root)){
            mkdir($root);
        }
        //新增目錄
        $new_path = $root;


        foreach(explode('&',$request->input('path')) as $v){
            $check = Upload::where('id',$v)->first();
            if(!empty($v)){
                $new_path .= '/'.$check->name;
                $p .= '/'.$check->name;
            }
        }


        //處理檔案上傳
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach($files as $file){
                $info = [
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                ];


                if (strpos ($info['original_filename'], "&")){
                    return back()->withErrors(['error'=>['不得有特殊字元「&」！']]);
                }
                if (strpos ($info['original_filename'], "\"")){
                    return back()->withErrors(['error'=>['不得有特殊字元「"」！']]);
                }
                if (strpos ($info['original_filename'], "'")){
                    return back()->withErrors(['error'=>["不得有特殊字元「'」！"]]);
                }


                if(file_exists(storage_path('app/'.$p.'/'.$info['original_filename']))){
                    return back()->withErrors(['error'=>['已有相同檔名！']]);
                }else{
                    $file->storeAs($p, $info['original_filename']);

                    $att['name'] = $info['original_filename'];
                    $att['type'] = 2;//檔案
                    $att['user_id'] = auth()->user()->id;
                    $att['folder_id'] = $request->input('folder_id');
                    Upload::create($att);
                }

            }
        }

        return redirect()->route('uploads.index',$request->input('path'));

    }
    public function download($path)
    {

        $path_array = explode('&',$path);
        $file_id = end($path_array);

        $file = "uploads";
        foreach($path_array as $v){
            if($v != $file_id and !empty($v)){
                $check = Upload::where('id',$v)->first();
                $file .= "&".$check->name;
            }
        }

        $upload = Upload::where('id',$file_id)->first();
        $file .= '&'.$upload->name;

        $file = str_replace('&','/',$file);
        $file = storage_path('app/public/'.$file);
        return response()->file($file);
    }

    public function delete($path)
    {
        $path_array = explode('&',$path);
        $id = end($path_array);
        $check = Upload::where('id',$id)->first();

        $new_path = "";
        $remove = "uploads";

        foreach($path_array as $v){
            if(!empty($v) and $v != $id){
                $new_path .= '&'.$v;
            }
            if(!empty($v)){
                $f = Upload::where('id',$v)->first();
                $remove .= "/".$f->name;
            }
        }

        if($check->type == "1"){
            if(is_dir(storage_path('app/public/'.$remove))){
                deldir(storage_path('app/public/'.$remove));
                $this->delete_folder($check->id);
            }

        }elseif($check->type == "2"){
            if(file_exists(storage_path('app/public/'.$remove))){
                unlink(storage_path('app/public/'.$remove));
            }
        }
        $check->delete();


        return redirect()->route('uploads.index',$new_path);
    }

    public function delete_folder($id)
    {
        $fs = Upload::where('folder_id',$id)->get();
        foreach($fs as $f){
            if($f->type=="1"){
                $this->delete_folder($f->id);
            }
            $f->delete();
        }
    }
}
