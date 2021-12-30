@extends('layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{ route('specials.review') }}">「特定人員名冊」管理列表</a></li>
            <li class="breadcrumb-item active" aria-current="page">人員與試劑名冊</li>
        </ol>
    </nav>
    <a href="#" onclick="history.back()" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
    <div class="card">
        <div class="card-header">
            <h5>
                <img src="{{ asset('images/icons/special.png') }}" height="40">
                人員與試劑名冊
            </h5>
        </div>
        <div class="card-body">
            <h4>特定人員列表</h4>
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th nowrap>
                        單位
                    </th>
                    <th nowrap>
                        班級
                    </th>
                    <th nowrap>
                        學號
                    </th>
                    <th nowrap>
                        姓名
                    </th>
                    <th nowrap>
                        性別
                    </th>
                    <th nowrap>
                        類別
                    </th>
                    <th nowrap>
                        備註
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($special_members as $special_member)
                    <tr>
                        <td nowrap>
                            @if(!empty($special_member->special->user->school_code))
                                {{ $schools[$special_member->special->user->school_code] }}
                            @else
                                {{ $special_member->special->user->name }}
                            @endif
                        </td>
                        <td nowrap>
                            {{ $special_member->class }}
                        </td>
                        <td nowrap>
                            {{ $special_member->number }}
                        </td>
                        <td nowrap>
                            {{ $special_member->name }}
                        </td>
                        <td nowrap>
                            {{ $special_member->sex }}
                        </td>
                        <td>
                            {{ $special_types[$special_member->special_type] }}
                            @if($special_member->special_type == 4 and !empty($special_member->filename))
                                同意書<a href="{{ route('specials.open',[$special_member,'member_agree']) }}" target="_blank"><i class="fas fa-download text-primary"></i></a>
                            @endif
                        </td>
                        <td>
                            {{ $special_member->note }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr>
            <h4>快速檢驗試劑名冊列表</h4>
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th nowrap>
                        篩檢名單
                    </th>
                    <th nowrap>
                        性別
                    </th>
                    <th nowrap>
                        學制
                    </th>
                    <th nowrap>
                        篩檢日期
                    </th>
                    <th>
                        使用篩劑類型
                    </th>
                    <th>
                        篩驗結果
                    </th>
                    <th>
                        備考
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($special_reagents as $special_reagent)
                    <tr>
                        <td>
                            {{ $special_reagent->name }}
                        </td>
                        <td>
                            {{ $special_reagent->sex }}
                        </td>
                        <td>
                            {{ $special_reagent->depart }}
                        </td>
                        <td>
                            {{ $special_reagent->date }}
                        </td>
                        <td>
                            {{ $reagent_brands[$special_reagent->reagent_brand] }}/{{ $reagent_types[$special_reagent->reagent_type] }}
                        </td>
                        <td>
                            {{ $special_reagent->result }}
                        </td>
                        <td>
                            {{ $special_reagent->note }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
