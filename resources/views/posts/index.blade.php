@extends('layouts.master')

@section('content')
    <h3>
        公告系統
    </h3>
    @auth
        @if(auth()->user()->admin==1)
            <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm">新增公告</a>
        @endif
    @endauth
    <table class="table table-striped" style="word-break:break-all;">
        <thead class="thead-light">
        <tr>
            <th nowrap>
                日期
            </th>
            <th nowrap>
                標題
            </th>
            <th nowrap>
                動作
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td nowrap>
                    {{ substr($post->created_at,0,10) }}
                </td>
                <td nowrap>
                    <a href="{{ route('posts.show',$post->id) }}">
                        {{ $post->title }}
                    </a>
                </td>
                <td nowrap>
                    @auth
                        @if(auth()->user()->admin==1)
                        <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary btn-sm">編輯</a>
                        <a href="{{ route('posts.destroy',$post->id) }}" class="btn btn-danger btn-sm" onclick="if(confirm('您確定要刪除嗎?')){return true;}else return false">刪除</a>
                        @endif
                    @endauth
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
@endsection
