@extends('layouts.master')

@section('content')
    <h3>
        <img src="{{ asset('images/icons/plan.png') }}" height="40">
        防制學生藥物濫用實施計畫(年度計畫)管理
    </h3>
    <br>
    <br>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('plans.review') }}">年度列表</a>
        </li>
        <li class="nav-item">

        </li>
    </ul>
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.search') }}" method="post">
                @csrf
                <input type="hidden" name="page" value="{{ $page }}">
                <table>
                    <tr>
                        <td>
                            <input type="number" class="form-control" name="this_year" id="this_year" value="{{ $this_year }}" maxlength="3" onchange="go_submit()">
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm"><i class="fas fa-recycle"></i> 切換年度</button>
                        </td>
                        <td>
                            <a class="btn btn-success btn-sm" href="{{ route('plans.statistics',$this_year) }}" onclick="return confirm('下載 {{ $this_year }} 年度？')"><i class="fas fa-download"></i> {{ $this_year }} 年度</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="want" id="want" placeholder="請輸入名稱" required>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i> 搜尋單位</button>
                        </td>
                        <td>

                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th>狀態</th>
                    <th>年度</th>
                    <th>單位</th>
                    <th>檔案</th>
                    <th>審核</th>
                </tr>
                </thead>
                <tbody>
                @foreach($plans as $plan)
                    <tr>
                        <td>{{ $status[$plan->status] }}</td>
                        <td>
                            {{ $plan->year }}
                        </td>
                        <td>
                            @if(!empty($plan->school_code))
                                {{ $schools[$plan->school_code] }}<br>
                                <small class="text-secondary">{{ $plan->created_at }}</small>
                            @else
                                {{ $plan->user->name }}
                            @endif
                        </td>
                        <td>
                            <?php
                            $d = (empty($plan->school_code))?$plan->user->username:$plan->school_code;
                            $files = get_files(storage_path('app/public/plans/'.$plan->year.'/'.$d));
                            ?>
                            @if(!empty($files))
                                @foreach($files as $file)
                                    <a href="{{ asset('storage/plans/'.$plan->year.'/'.$d.'/'.$file) }}" target="_blank">
                                        <span class="btn btn-outline-primary btn-sm"><i class="fas fa-download"></i></span>
                                    </a>
                                @endforeach
                            @else
                                檔案遺失
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('plans.back',$plan->id) }}" method="post" onsubmit="return confirm('確定退件嗎？')">
                                @csrf
                                <input type="text" name="review_desc" placeholder="說明" value="{{ $plan->review_desc }}">
                                <input type="hidden" name="page" value="{{ $page }}">
                                @if($plan->status <>4)
                                    <a class="btn btn-success btn-sm" href="{{ route('plans.ok',[$plan->year,$plan->id,$page]) }}" onclick="return confirm('確定通過？')"><i class="fas fa-check"></i> 通過</a>
                                    @if($plan->status <>2)
                                    <button class="btn btn-warning btn-sm"><i class="fas fa-undo"></i> 退件</button>
                                    @endif
                                @endif
                            </form>
                            @if(!empty($plan->reviewed_at))
                                <small class="text-secondary">({{ $plan->reviewed_at }})</small>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $plans->links() }}
        </div>
    </div>
    <script>
        function go_submit(){
            this_year = $('#this_year').val();
            window.location.href = '{{ url('review1/plans/') }}'+'/'+this_year;
        }
    </script>
@endsection
