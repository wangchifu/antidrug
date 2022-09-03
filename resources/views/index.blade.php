@extends('layouts.master')

@section('left_image')
    <section class="latest-product spad" style="margin-top: -50px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="latest-product__text">
                        <h4>最新宣導</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach($educator_propagandas as $educator_propaganda)
                                <a href="{{ route('educator_propagandas.show',$educator_propaganda->id) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        @if(count($educator_propaganda->pics)>0)
                                        <img src="{{ asset('storage/educator_propagandas/'.$educator_propaganda->id.'/'.$educator_propaganda->pics->first()->pic) }}" alt="" style="max-width: 150px;">
                                        @endif
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ mb_cht_limit($educator_propaganda->title,10) }}</h6>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach($student_propagandas as $student_propaganda)
                                    <a href="{{ route('student_propagandas.show',$student_propaganda->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            @if(count($student_propaganda->pics)>0)
                                            <img src="{{ asset('storage/student_propagandas/'.$student_propaganda->id.'/'.$student_propaganda->pics->first()->pic) }}" alt="" style="max-width: 150px;">
                                            @endif
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ mb_cht_limit($student_propaganda->title,10) }}</h6>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach($parent_propagandas as $parent_propaganda)
                                    <a href="{{ route('parent_propagandas.show',$parent_propaganda->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            @if(count($parent_propaganda->pics)>0)
                                            <img src="{{ asset('storage/parent_propagandas/'.$parent_propaganda->id.'/'.$parent_propaganda->pics->first()->pic) }}" alt="" style="max-width: 150px;">
                                            @endif
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ mb_cht_limit($parent_propaganda->title,10) }}</h6>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach($tzuchi_propagandas as $tzuchi_propaganda)
                                    <a href="{{ route('tzuchi_propagandas.show',$tzuchi_propaganda->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            @if(count($tzuchi_propaganda->pics)>0)
                                            <img src="{{ asset('storage/tzuchi_propagandas/'.$tzuchi_propaganda->id.'/'.$tzuchi_propaganda->pics->first()->pic) }}" alt="" style="max-width: 150px;">
                                            @endif
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ mb_cht_limit($tzuchi_propaganda->title,10) }}</h6>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach($other_propagandas as $other_propaganda)
                                    <a href="{{ route('other_propagandas.show',$other_propaganda->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            @if(count($other_propaganda->pics)>0)
                                            <img src="{{ asset('storage/other_propagandas/'.$other_propaganda->id.'/'.$other_propaganda->pics->first()->pic) }}" alt="" style="max-width: 150px;">
                                            @endif
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ mb_cht_limit($other_propaganda->title,10) }}</h6>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach($boe_actives as $boe_active)
                                    <a href="{{ route('boe_actives.show',$boe_active->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            @if(count($boe_active->pics)>0)
                                            <img src="{{ asset('storage/boe_actives/'.$boe_active->id.'/'.$boe_active->pics->first()->pic) }}" alt="" style="max-width: 150px;">
                                            @endif
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ mb_cht_limit($boe_active->title,10) }}</h6>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach($center_actives as $center_active)
                                    <a href="{{ route('center_actives.show',$center_active->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            @if(count($center_active->pics)>0)
                                            <img src="{{ asset('storage/center_actives/'.$center_active->id.'/'.$center_active->pics->first()->pic) }}" alt="" style="max-width: 150px;">
                                            @endif
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ mb_cht_limit($center_active->title,10) }}</h6>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <style>
        @keyframes caret {
            50% { border-color: transparent; }
        }
        .type {
            width:11em;
            border-right:.05em solid;
            overflow:hidden;
            white-space:nowrap;
            animation: typing 3s steps(11);

        }
    </style>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php $n=0; ?>
            @foreach($title_images as $title_image)
            <?php $c = ($n==0)?"active":null; ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $n }}" class="{{ $c }}"></li>
            <?php $n++; ?>
            @endforeach
        </ol>
        <div class="carousel-inner">
            <?php $n=0; ?>
            @foreach($title_images as $title_image)
            <?php $c = ($n==0)?"active":null; ?>
            <div class="carousel-item {{ $c }}">
                @if(!empty($title_image->link))
                    <a href="{{ $title_image->link }}" target="_blank"><img class="d-block w-100" src="{{ asset('storage/title_images/'.$title_image->photo_name) }}"></a>
                @else
                    <img class="d-block w-100" src="{{ asset('storage/title_images/'.$title_image->photo_name) }}">
                @endif
                <div class="carousel-caption d-none d-md-block">
                    <!--
                    <h3 style="color: white; text-shadow: black 0.1em 0.1em 0.2em">{{ $title_image->title }}</h3>
                    <p style="color: black;text-shadow: 0.1em 0.1em 0.2em white">{{ $title_image->content }}</p>
                    -->
                </div>
            </div>
            <?php $n++; ?>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <hr>
    <h3>最新公告</h3>
    @auth
        @if(auth()->user()->admin==1)
            <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm">新增公告</a>
        @endif
    @endauth
    <table class="table table-striped">
        @foreach($posts as  $post)
        <tr>
            <td style="word-break: break-all;">
                <h5 onclick="show('content{{ $post->id }}')"><a href="{{ route('posts.show',$post->id) }}">{{ $post->title }}</a></h5>
                <small class="text-secondary">{{ $post->user->name }} / {{ $post->created_at }} / {{ $post->views }}</small>
            </td>
        </tr>
        @endforeach
    </table>
    <a href="{{ route('posts.index') }}" class="primary-btn">更多公告</a>
@endsection

@section('section')
    <!-- Categories Section Begin -->

    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach($telephone_propagandas as $telephone_propaganda)
                        @if(count($telephone_propaganda->pics) > 0)
                            <div class="col-lg-3">
                                <div class="categories__item set-bg" data-setbg="{{ asset('storage/telephone_propagandas/'.$telephone_propaganda->id.'/'.$telephone_propaganda->pics->first()->pic) }}">
                                    <h5><a href="{{ route('telephone_propagandas.show',$telephone_propaganda->id) }}">{{ $telephone_propaganda->title }}</a></h5>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <!-- Latest Product Section Begin -->
    <!--
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->
    <!-- Latest Product Section End -->
    <!-- Blog Section Begin -->
    <!--
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->
    <!-- Blog Section End -->
@endsection
