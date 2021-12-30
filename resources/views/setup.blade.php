@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>
                網站資訊
            </h5>
        </div>
        <div class="card-body">
            {{ Form::open(['route' => ['setups.update',$setup->id], 'method' => 'post']) }}
            <div class="form-group">
                <label for="website_name"><strong class="text-dark">網站名稱</strong></label>
                {{ Form::text('website_name',$setup->website_name,['id'=>'website_name','class' => 'form-control', 'required' => 'required']) }}
            </div>
            <div class="form-group">
                <label for="address"><strong class="text-dark">聯絡地址</strong></label>
                {{ Form::text('address',$setup->address,['id'=>'address','class' => 'form-control', 'placeholder' => '非必填']) }}
            </div>
            <div class="form-group">
                <label for="telephone"><strong class="text-dark">聯絡電話</strong></label>
                {{ Form::text('telephone',$setup->telephone,['id'=>'telephone','class' => 'form-control', 'placeholder' => '非必填']) }}
            </div>
            <div class="form-group">
                <label for="fax"><strong class="text-dark">傳真電話</strong></label>
                {{ Form::text('fax',$setup->fax,['id'=>'fax','class' => 'form-control', 'placeholder' => '非必填']) }}
            </div>
            <div class="form-group">
                <label for="contact_person1"><strong class="text-dark">主要聯絡人</strong></label>
                {{ Form::text('contact_person1',$setup->contact_person1,['id'=>'contact_person1','class' => 'form-control', 'placeholder' => '非必填']) }}
            </div>
            <div class="form-group">
                <label for="contact_email1"><strong class="text-dark">主要聯絡人 Email</strong></label>
                {{ Form::text('contact_email1',$setup->contact_email1,['id'=>'contact_email1','class' => 'form-control', 'placeholder' => '非必填']) }}
            </div>
            <div class="form-group">
                <label for="contact_person2"><strong class="text-dark">次要聯絡人</strong></label>
                {{ Form::text('contact_person2',$setup->contact_person2,['id'=>'contact_person2','class' => 'form-control', 'placeholder' => '非必填']) }}
            </div>
            <div class="form-group">
                <label for="contact_email2"><strong class="text-dark">次要聯絡人 Email</strong></label>
                {{ Form::text('contact_email2',$setup->contact_email2,['id'=>'contact_email2','class' => 'form-control', 'placeholder' => '非必填']) }}
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
