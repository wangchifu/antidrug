@extends('layouts.master')

@section('content')
    <h3>文章列表</h3>
    <a href="{{ route('articles.create') }}" class="btn btn-success btn-sm">增加文章</a>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th>
                ID
            </th>
            <th>標題</th>
            <th>動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>
                    {{ $article->id }}
                </td>
                <td>
                    <a href="{{ route('articles.show',$article->id) }}" target="_blank">{{ $article->title }}</a>
                </td>
                <td>
                    <a href="{{ route('articles.edit',$article->id) }}" class="btn btn-primary btn-sm">編輯</a>
                    <a href="{{ route('articles.destroy',$article->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a><br>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
