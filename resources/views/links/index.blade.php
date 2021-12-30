@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="py-2">
                選單連結
            </h3>
        </div>
        <div class="card-body">
            {{ Form::open(['route' => 'links.store', 'method' => 'post']) }}
            <div class="form-group">
                <label for="name"><strong class="text-dark">標題</strong></label>
                {{ Form::text('name',null,['id'=>'name','class' => 'form-control', 'required' => 'required']) }}
            </div>
            <div class="form-group">
                <label for="url"><strong class="text-dark">網址</strong></label>
                {{ Form::text('url',null,['id'=>'url','class' => 'form-control', 'placeholder' => '非必填']) }}
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="target" name="target" value="_blank">
                    <label class="form-check-label" for="target">開新視窗</label>
                </div>
            </div>
            <div class="form-group">
                <label for="order_by"><strong class="text-dark">排序</strong></label>
                {{ Form::number('order_by',null,['id'=>'order_by','class' => 'form-control', 'placeholder' => '非必填']) }}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('確定儲存嗎？')">
                    <i class="fas fa-save"></i> 新增連結
                </button>
            </div>
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            {{ Form::close() }}
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th class="col-4">標題</th>
            <th>網址</th>
            <th>排序</th>
            <th>動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($links as $link)
            <tr>
                <td>
                    {{ $link->name }}
                </td>
                <td>
                    @if($link->target=="_blank")
                        <span class="badge badge-danger">新</span>
                    @endif
                    <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
                </td>
                <td>
                    {{ $link->order_by }}
                </td>
                <td>
                    <a href="{{ route('links.edit',$link->id) }}" class="btn btn-primary btn-sm">編輯</a>
                    <a href="{{ route('links.destroy',$link->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a><br>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
