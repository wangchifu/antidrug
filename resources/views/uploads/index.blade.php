@extends('layouts.master')

@section('content')
    @auth
        @if(auth()->user()->admin==1)
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="py-2">
                        檔案掛載
                    </h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                {{ Form::open(['route' => 'uploads.create_folder', 'method' => 'POST','id'=>'this_form','onsubmit'=>"return submitOnce(this)"]) }}
                                <div class="form-group">
                                    {{ Form::text('name',null,['id'=>'name','class' => 'form-control','placeholder'=>'名稱','required'=>'required']) }}
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="folder_id" value="{{ $folder_id }}">
                                    <input type="hidden" name="path" value="{{ $path }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <button class="btn btn-success btn-sm" id="submit_button" onclick="if(confirm('您確定新增子目錄嗎?')){change_button1();return true;}else return false"><i class="fas fa-plus"></i> 在此新增目錄</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                            <div class="col-6">
                                {{ Form::open(['route' => 'uploads.upload_file', 'method' => 'POST','id'=>'this_form2','files' => true,'onsubmit'=>"return submitOnce(this)"]) }}
                                <div class="form-group">
                                    {{ Form::file('files[]', ['class' => 'form-control','multiple'=>'multiple','required'=>'required']) }}
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="folder_id" value="{{ $folder_id }}">
                                    <input type="hidden" name="path" value="{{ $path }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <button class="btn btn-success btn-sm" id="submit_button2" onclick="if(confirm('您確定新增檔案嗎?')){change_button2();return true;}else return false"><i class="fas fa-plus"></i> 在此新增檔案</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    @include('layouts.errors')
                </div>
            </div>
            <hr>
        @endif
    @endauth
    <?php
    $final = end($folder_path);
    $final_key = key($folder_path);
    $p="";
    $f="app/public/uploads";
    $last_folder = "";
    ?>
    <h3>檔案下載</h3>
    路徑：
    @foreach($folder_path as $k=>$v)
        <?php
        if($k=="0"){
            $k = null;

        }else{
            $p .= '&'.$k;
            $f .=  '/'.$v;
        }
        if($k != $final_key and !empty($k)){
            $last_folder .= '&'.$k;
        }

        ?>
        @if($v == $final)
            <i class="fa fa-folder-open text-warning"></i> <a href="{{ route('uploads.index',$p) }}">{{$v}}</a>/
        @else
            <i class="fa fa-folder text-warning"></i> <a href="{{ route('uploads.index',$p) }}">{{$v}}</a>/
        @endif
    @endforeach
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th>目錄/檔案名稱</th>
            <th>數量/檔案大小</th>
            <th>建立者</th>
            <th>建立時間</th>
        </tr>
        </thead>
        <tbody>
        @if($path!=null)
            <tr>
                <td><i class="fas fa-arrow-circle-left"></i> <a href="{{ route('uploads.index',$last_folder) }}">上一層</a></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endif
        @foreach($folders as $folder)
            <?php
            $folder_p = $path.'&'.$folder->id;
            ?>
            <tr>
                <td>
                    <i class="fas fa-folder text-warning"></i> <a href="{{ route('uploads.index',$folder_p) }}">{{ $folder->name }}</a></td>
                </td>
                <td>
                    <?php $n = \App\Models\Upload::where('folder_id',$folder->id)->count();?>
                    {{ $n }} 個項目
                    @auth
                        @if(auth()->user()->admin==1)
                            <a href="{{ route('uploads.delete',$folder_p) }}" id="delete_folder{{ $folder->id }}" onclick="return confirm('確定刪除目錄嗎？')"><i class="fas fa-minus-square text-danger"></i></a>
                        @endif
                    @endauth
                </td>
                <td>
                    {{ $folder->user->name }}
                </td>
                <td>
                    @if(file_exists(storage_path($f.'/'.$folder->name)))
                    {{ date ("Y-m-d H:i:s",filemtime(storage_path($f.'/'.$folder->name))) }}
                    @endif
                </td>
            </tr>
        @endforeach
        @foreach($files as $file)
            <?php
            $file_p = $path.'&'.$file->id;
            ?>
            <tr>
                <td>
                    @if(file_exists(storage_path($f.'/'.$file->name)))
                        <i class="fas fa-file text-info"></i> <a href="{{ route('uploads.download',$file_p) }}" target="_blank">{{ $file->name }}</a>
                    @else
                        <span class="text-danger"><i class="fas fa-file"></i> {{ $file->name }}</span>
                    @endif
                </td>
                <td>
                    @if(file_exists(storage_path($f.'/'.$file->name)))
                        {{ filesizekb(storage_path($f.'/'.$file->name)) }} KB
                    @else
                        <small class="text-danger">已遺失</small>
                    @endif
                    @auth
                        @if(auth()->user()->admin==1)
                            <a href="{{ route('uploads.delete',$file_p) }}" id="delete_file{{ $file->id }}" onclick="return confirm('確定刪除？')"><i class="fas fa-minus-square text-danger"></i></a>
                        @endif
                    @endauth
                </td>
                <td>
                    {{ $file->user->name }}
                </td>
                <td>
                    @if(file_exists(storage_path($f.'/'.$file->name)))
                        {{ date ("Y-m-d H:i:s",filemtime(storage_path($f.'/'.$file->name))) }}
                    @else
                        <small class="text-danger">已遺失</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
