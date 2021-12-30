@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/telephone.png') }}" height="40">
                學校辦理戒毒成功專線宣導(一年一次)
            </h5>
        </div>
        <div class="card-body">
            <a href="{{ route('telephone_propagandas.create') }}" class="btn btn-success btn-sm">新增資料</a>
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th>宣導日期</th>
            <th>單位</th>
            <th>宣導名稱</th>
            <th>照片</th>
            <th>動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($telephone_propagandas as $telephone_propaganda)
            <tr>
                <td>
                    {{ $telephone_propaganda->date }}
                </td>
                <td>
                    @if(!empty($telephone_propaganda->user->school_code))
                        {{ $schools[$telephone_propaganda->user->school_code] }}
                    @else
                        {{ $telephone_propaganda->user->name }}
                    @endif
                    <br>
                    <small class="text-secondary">{{ $telephone_propaganda->created_at }}</small>
                </td>
                <td>
                    <a href="{{ route('telephone_propagandas.show',$telephone_propaganda->id) }}">
                        {{ $telephone_propaganda->title }}
                    </a>
                </td>
                <td>{{ count($telephone_propaganda->pics) }}</td>
                <td>
                    @if($telephone_propaganda->user_id == auth()->user()->id)
                        <a href="{{ route('telephone_propagandas.edit',$telephone_propaganda->id) }}" class="btn btn-primary btn-sm">修改</a>
                        <a href="{{ route('telephone_propagandas.destroy',$telephone_propaganda->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除？')">刪除</a>
                    @else
                        <small class="text-secondary">{{ $telephone_propaganda->user->name }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $telephone_propagandas->links() }}
@endsection
