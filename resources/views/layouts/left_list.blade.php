<div class="hero__categories">
    <div class="hero__categories__all">
        <i class="fa fa-bars"></i>
        <span>功能列表</span>
    </div>
    <ul>
        <li><a href="{{ route('posts.index') }}">公告系統</a></li>
        <li><a href="{{ route('uploads.index') }}">檔案下載</a></li>
        <li><a href="{{ route('propagandas.propaganda') }}">全縣宣導記錄</a></li>
        <?php
            $links = \App\Models\Link::orderBy('order_by')->get();
        ?>
        @foreach($links as $link)
        <li><a href="{{ $link->url }}" target="{{ $link->target }}">{{ $link->name }}</a></li>
        @endforeach
    </ul>
</div>
