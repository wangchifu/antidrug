@extends('layouts.master_clean')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">公告列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增公告</li>
        </ol>
    </nav>
    {{ Form::open(['route' => 'posts.store', 'method' => 'post', 'files' => true]) }}
    <div class="card my-4">
        <h3 class="card-header">公告內容</h3>
        <div class="card-body">
            <div class="form-group">
                <label for="title"><strong>標題*</strong></label>
                {{ Form::text('title',null,['id'=>'title','class' => 'form-control','required'=>'required','placeholder' => '請輸入標題']) }}
            </div>
            <div class="form-group">
                <label for="content"><strong>內文*</strong></label>
                {{ Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control', 'rows' => 10,'required'=>'required', 'placeholder' => '請輸入內容']) }}
            </div>
            <script src="{{ asset('mycke/ckeditor.js') }}"></script>
            <script>
                CKEDITOR.replace('content'
                    ,{
                        toolbar: [
                            { name: 'document', items: [ 'Bold', 'Italic','TextColor','-','BulletedList','NumberedList','-','Link','Unlink','-','Outdent', 'Indent', '-', 'Undo', 'Redo' ] },
                        ],
                        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images',
                        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files',
                    });
            </script>
            <div class="form-group">
                <label for="link">相關連結</label>
                {{ Form::text('link',null,['id'=>'link','class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="files[]">
                    附件(單檔不可超過5MB)
                </label>
                {{ Form::text('file_desc',null,['id'=>'file_desc','class' => 'form-control','placeholder' => '附檔說明']) }}
                {{ Form::file('files[]', ['class' => 'form-control','multiple'=>'multiple']) }}
            </div>
            <div class="form-group">
                <label for="pics[]">
                    附圖(只會顯示圖檔，單檔不可超過5MB，上傳後會自動縮圖)
                </label>
                {{ Form::text('pic_desc',null,['id'=>'pic_desc','class' => 'form-control','placeholder' => '附圖說明']) }}
                {{ Form::file('pics[]', ['class' => 'form-control','multiple'=>'multiple','accept'=>'image/*']) }}
            </div>
            <div class="form-group">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
                <button type="submit" id="submit_button" class="btn btn-primary btn-sm" onclick="if(confirm('您確定送出嗎?')){return true;}else return false">
                    <i class="fas fa-save"></i> 儲存設定
                </button>
            </div>
            @include('layouts.form_errors')
        </div>
    </div>
    {{ Form::close() }}
@endsection
