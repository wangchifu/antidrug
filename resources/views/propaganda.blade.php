@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>
                全縣宣導記錄
            </h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="class">宣導類別</label><br>
                <select name="type" id="type" class="form-group" onchange="go_submit()">
                    @foreach($types as $k=>$v)
                        <?php
                            $selected = ($k==$propaganda_type)?"selected":null;
                        ?>
                        <option value="{{ $k }}" {{ $selected }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th nowrap>宣導日期</th>
                    <th nowrap>單位</th>
                    <th nowrap>名稱</th>
                    <th nowrap>照片</th>
                </tr>
                </thead>
                <tbody>
                @foreach($propagandas as $propaganda)
                    <tr>
                        <td nowrap>
                            {{ $propaganda->date }}
                        </td>
                        <td>
                            @if(!empty($propaganda->user->school_code))
                                {{ $schools[$propaganda->user->school_code] }}
                            @else
                                {{ $propaganda->user->name }}
                            @endif
                            <br>
                            <small class="text-secondary">{{ $propaganda->created_at }}</small>
                        </td>
                        <td>
                            <a href="{{ route($propaganda_type.'.show',$propaganda->id) }}">
                                {{ $propaganda->title }}
                            </a>
                        </td>
                        <td>{{ count($propaganda->pics) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $propagandas->links() }}
        </div>
    </div>
    <script>
        function go_submit(){
            type = $('#type').val();
            window.location.href = '{{ url('propaganda/') }}'+'/'+type;
        }
    </script>
@endsection
