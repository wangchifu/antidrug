@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('links.index') }}">「選單連結」列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">修改選單連結</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header text-center">
            <h3 class="py-2">
                選單連結
            </h3>
        </div>
        <div class="card-body">
            {{ Form::open(['route' => ['links.update',$link->id], 'method' => 'post']) }}
            <div class="form-group">
                <label for="name"><strong class="text-dark">標題</strong></label>
                {{ Form::text('name',$link->name,['id'=>'name','class' => 'form-control', 'required' => 'required']) }}
            </div>
            <div class="form-group">
                <label for="url"><strong class="text-dark">網址</strong></label>
                {{ Form::text('url',$link->url,['id'=>'url','class' => 'form-control', 'placeholder' => '非必填']) }}
            </div>
            <div class="form-group">
                <div class="form-check">
                    <?php $checked = ($link->target=="_blank")?"checked":null; ?>
                    <input type="checkbox" class="form-check-input" id="target" name="target" value="_blank" {{ $checked }}>
                    <label class="form-check-label" for="target">開新視窗</label>
                </div>
            </div>
            <div class="form-group">
                <label for="order_by"><strong class="text-dark">排序</strong></label>
                {{ Form::number('order_by',$link->order_by,['id'=>'order_by','class' => 'form-control', 'placeholder' => '非必填']) }}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('確定儲存嗎？')">
                    <i class="fas fa-save"></i> 儲存連結
                </button>
            </div>
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
        </div>
    </div>
@endsection
