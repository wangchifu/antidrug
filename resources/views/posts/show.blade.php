@extends('layouts.master_clean')

@section('content')
    <a href="#" class="btn btn-light btn-sm" onclick="history.back()"><i class="fas fa-arrow-alt-circle-left"></i> 返回</a>
    @if($last_id)
        <a href="{{ route('posts.show',$last_id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-alt-circle-up"></i> 上一則公告</a>
    @else
        <a href="#" class="btn btn-secondary btn-sm disabled"><i class="fas fa-arrow-alt-circle-left"></i> 上一則公告</a>
    @endif
    @if($next_id)
        <a href="{{ route('posts.show',$next_id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-alt-circle-down"></i> 下一則公告</a>
    @else
        <a href="#" class="btn btn-secondary btn-sm disabled"><i class="fas fa-arrow-alt-circle-right"></i> 下一則公告</a>
    @endif
    <div class="card my-4">
        <div class="card-header">
            <h3>{{ $post->title }}</h3>
            <small class="text-secondary">{{ $post->user->name }} / {{ $post->created_at }} / {{ $post->views }}</small>
        </div>
        <div class="card-body">
            {!! $post->content !!}
            <?php
            $pics = get_files(storage_path('app/public/posts/'.$post->id.'/photos/'));
            $files = get_files(storage_path('app/public/posts/'.$post->id.'/files/'));
            ?>
            @if(!empty($post->link))
                <hr>
                相關連結：<a href="{{ $post->link }}" target="_blank">{{ $post->link }}</a>
            @endif
            @if(isset($pics[0]))
                <hr>
                <figcaption class="figure-caption">{{ $post->pic_desc }}</figcaption>
                @foreach($pics as $k=>$v)
                    <figure class="figure col-3">
                        <a href="{{ asset('storage/posts/'.$post->id.'/photos/'.$v) }}" class="venobox" data-gall="gall1">
                            <img src="{{ asset('storage/posts/'.$post->id.'/photos/'.$v) }}" class="figure-img img-fluid rounded" alt="...">
                        </a>
                    </figure>
                @endforeach
            @endif
            @if(isset($files[0]))
                <hr>
                <figcaption class="figure-caption">{{ $post->file_desc }}</figcaption>
                <?php
                $i=1;
                ?>
                @foreach($files as $k=>$v)
                    <a href="{{ asset('storage/posts/'.$post->id.'/files/'.$v) }}" target="_blank">
                        <span class="btn btn-primary btn-sm"><i class="fas fa-download"></i>附件 {{ $i }}</span>
                    </a>
                    <?php $i++; ?>
                @endforeach
            @endif
        </div>
    </div>
@endsection
