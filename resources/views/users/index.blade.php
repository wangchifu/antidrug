@extends('layouts.master')

@section('content')
    <h3>
        全站帳號管理
    </h3>
    <div class="card my-4">
        <h4 class="card-header">列表</h4>
        <div class="card-body">
            <form action="{{ route('users.search') }}" method="post">
            @csrf
            <table>
                <tr>
                    <td>
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">新增本機帳號</a>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="want" placeholder="請輸入名稱">
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i> 搜尋單位</button>
                    </td>
                </tr>
            </table>
            </form>
            <table class="table table-striped" style="word-break:break-all;">
                <thead class="thead-light">
                <tr>
                    <th>狀況</th>
                    <th>姓名(帳號)</th>
                    <th>類型</th>
                    <th>動作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            @if($user->disable)
                                <i class="fas fa-times-circle text-danger"></i>
                            @else
                                <i class="fas fa-check-circle text-success"></i>
                            @endif
                        </td>
                        <td>
                            @if($user->admin)
                                <i class="fas fa-crown"></i>
                            @endif
                            @if(!empty($user->school_code))
                                {{ $schools[$user->school_code] }}
                            @endif
                            {{ $user->name }} ({{ $user->username }})
                        </td>
                        <td>
                            @if($user->type=="local")
                                本機帳號
                            @elseif($user->type=="gsuite")
                                gsuite帳號
                            @endif
                        </td>
                        <td>
                            @if($user->type=="local")
                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i> 修</a>
                                <a href="{{ route('users.reset_pwd',$user->id) }}" class="btn btn-warning btn-sm" onclick="return confirm('確定還原密碼為 {{ env('DEFAULT_PWD') }}？')">密</a>
                            @endif
                            @if($user->disable==1)
                                <a href="{{ route('users.disable',$user->id) }}" class="btn btn-success btn-sm" onclick="return confirm('確定恢復帳號？')">復</a>
                            @else
                                <a href="{{ route('users.disable',$user->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定停用帳號？')">停</a>
                            @endif

                            <a href="{{ route('sims.impersonate',$user->id) }}" class="btn btn-secondary btn-sm" onclick="return confirm('確定模擬登入？')"><i class="fas fa-user-ninja"></i> 模擬</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection
