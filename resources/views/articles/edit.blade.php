@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">「文章內容」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">修改文章內容</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header text-center">
            <h3 class="py-2">
                文章內容
            </h3>
        </div>
        <div class="card-body">
            {{ Form::open(['route' => ['articles.update',$article->id], 'method' => 'post']) }}
            <div class="form-group">
                <label for="title"><strong class="text-dark">標題</strong></label>
                {{ Form::text('title',$article->title,['id'=>'title','class' => 'form-control', 'required' => 'required']) }}
            </div>
            <div class="form-group">
                <label for="content"><strong class="text-dark">內容</strong></label>
                {{ Form::textarea('content',$article->content,['id'=>'content','class' => 'form-control']) }}
            </div>
            <script src="{{ asset('mycke/ckeditor.js') }}"></script>
            <script>
                CKEDITOR.replace('content'
                    ,{
                        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images',
                        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files',
                    });
            </script>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('確定儲存嗎？')">
                    <i class="fas fa-save"></i> 修改文章
                </button>
            </div>
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
        </div>
    </div>
@endsection
