<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //下載已上傳之檔案
    public function getFile($file)
    {
        $file = str_replace('&','/',$file);
        $file = storage_path('app/public/'.$file);
        return response()->download($file);
    }

    //不要強制下載，要線上打開
    public function open($file_path)
    {
        $file_path = str_replace('&&','/',$file_path);
        $file = storage_path('app/public/upload/'.$file_path);

        return response()->file($file);
    }
}
