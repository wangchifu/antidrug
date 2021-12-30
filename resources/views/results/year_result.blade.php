@extends('layouts.master')

@section('content')
    @if(!empty(auth()->user()->school_code))
        <h3>{{ $schools[auth()->user()->school_code] }}</h3>
    @else
        <h3>{{ auth()->user()->name }}</h3>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/results.png') }}" height="40">
                年度成果
            </h5>
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <td>
                        <input type="number" class="form-control" name="this_year" id="this_year" value="{{ $this_year }}" maxlength="3" onchange="go_submit()">
                    </td>
                    <td>
                        <a href="{{ route('year_result_download',$this_year) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-download"></i> 下載 {{ $this_year }} 年度成果報告</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        function go_submit(){
            this_year = $('#this_year').val();
            window.location.href = '{{ url('result/year_result/') }}'+'/'+this_year;
        }
    </script>
@endsection
