@extends('layout')
@php
    $banner = $product->getMedia(enum('media.product.banner'))[0];
    $gallery = $product->getMedia(enum('media.product.gallery'));
@endphp
@section('content')
    <div class="bg-white flex flex-wrap container py-2">
        
        <div class="swiper simple -mx-4 overflow-hidden md:hidden" column="1" >
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{$banner->getFullUrl()}}" alt="">
                </div>
                @foreach ($gallery as $media)
                    <div class="swiper-slide">
                        <div class="p-4">
                            <img src="{{$media->getFullUrl()}}" alt="">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-1/7 product-images hidden md:block">
            <div class="swiper simple overflow-hidden h-screen/7" column="3" direction="vertical" >
                <div class="swiper-wrapper">
                    @foreach ($gallery as $i => $media)
                        <div class="swiper-slide flex items-center justify-center p-1 border-box" style="box-sizing: border-box">
                            <img class="max-h-full" media-gallery="{{1+$i}}" src="{{$media->getFullUrl()}}" alt="">
                        </div>
                    @endforeach
                    @foreach ($gallery as $i => $media)
                        <div class="swiper-slide flex items-center justify-center p-1 border-box" style="box-sizing: border-box">
                            <img class="max-h-full" media-gallery="{{1+$i}}" src="{{$media->getFullUrl()}}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="product-image w-1/3 items-center justify-center h-screen/7 hidden md:flex">
            <img class="max-h-full" media-gallery="0" src="{{$banner->getFullUrl()}}" alt="">
        </div>

        <div class="md:w-1/3 pr-8">
            <h1 class="title">{{$product->title}}</h1>
            <div class="flex caption pb-6">
                @php
                    $number = 10;
                    $rating = 2.7;
                @endphp
                @component('components.star-rating', [
                    'number' => $number,
                    'rating' => $rating,
                ])@endcomponent
                <p class="px-2">( رای {{$number}})</p>
                <p class="px-2">{{$rating}}</p>

            </div>
            <div class="price flex justify-between items-center py-6">
                <p class=""><del>1,000,000 تومان</del></p>
                <p class="title-2">@toman($product->price)</p>
                <p class="rounded-full bg-grey py-1 pl-2"><span class="rounded-full border-4 border-white bg-grey-dark ml-2 p-1">38%</span><span class=""> 1,500,000 تومان</span></p>
            </div>
            <div class="flex justify-between items-center py-6 caption">
                <div class="flex items-center">
                    <i class="material-icons pl-2">store_mall_directory</i>
                    @forelse($product->businesses as $business)
                        <p class="">{{$business->brand}}</p>
                    @empty
                        مدلا
                    @endforelse
                </div>
                <p class="rounded-full bg-green text-white px-2">رضایت خرید : {{$rating*10}}%</p>
                <div class="flex items-center">
                    <i class="material-icons pl-2">access_time</i>
                    <span>زمان تحویل ۲۲ دی ماه</span>  
                </div> 
            </div>
            @if($is_favorite)
                <a
                        style="text-decoration: none"
                        href="{{ route('wishlist.destroy', $product->slug) }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('remove_product_from_wishlist').submit();"
                >
                    حذف از علاقه مندی ها
                </a>
                <form id="remove_product_from_wishlist" action="{{ route('wishlist.destroy', $product->slug) }}" method="post" style="display: none;">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}}
                </form>
            @else
                <a
                        style="text-decoration: none"
                        href="{{ route('wishlist.store', $product->slug) }}"
                >
                    افزودن به علاقه مندی ها
                </a>
            @endif
            <div class="size">
            </div>    
            <div class="py-6">
                    @component('components.form.text', [
                        'label' => 'انتخاب پارچه',
                        'outlined' => true,
                        'shaped' => true
                    ])@endcomponent
            </div> 
            <div class="flex items-center justify-between py-6">
                    @component('components.form.button', [
                        'label' => 'افزودن به سبد خرید',
                        'raised' => true,
                    ])@endcomponent
                    @component('components.form.button', [
                        'label' => 'خودم طراحی می کنم',
                        'raised' => true,
                    ])@endcomponent
                    <i class="material-icons p-1 rounded-full bg-grey">favorite_border</i>
                    <i class="material-icons p-1 rounded-full bg-grey">share</i>

            </div>
        </div> 

        <div class="product-gallery bg-white hidden pin-y pin-x w-full h-full z-50 ">
            <div class="w-full flex">
                <div class="w-1/8 flex flex-col">
                    <div class="close hover:bg-grey-lighter h-screen/15 flex items-center justify-center" >
                        <i class="material-icons">close</i>
                    </div>
                    <div class="prev hover:bg-grey-lighter w-full flex items-center justify-center h-screen/7">
                        <i class="material-icons">chevron_right</i>
                    </div>
                </div>
                <div class="banner w-full flex items-center justify-center p-4">
                    <img src="{{$banner->getFullUrl()}}" >
                </div>
                <div class="w-1/8 flex items-center justify-center">
                    <div class="next hover:bg-grey-lighter w-full flex items-center justify-center h-screen/7">
                        <i class="material-icons">chevron_left</i>
                    </div>
                </div>
            </div>
            <div class="w-1/7 b-r">
                <div class="swiper  overflow-hidden h-full" column="5" direction="vertical" >
                    <div class="swiper-wrapper">
                        <div class="swiper-slide flex justify-center p-1" style="box-sizing: border-box">
                            <img class="max-h-full" src="{{$banner->getFullUrl()}}" >
                        </div>
                        @foreach ($gallery as $media)
                            <div class="swiper-slide flex justify-center p-1" style="box-sizing: border-box">
                                <img class="max-h-full" src="{{$media->getFullUrl()}}" >
                            </div>
                        @endforeach
                        @foreach ($gallery as $media)
                            <div class="swiper-slide flex justify-center p-1" style="box-sizing: border-box">
                                <img class="max-h-full" src="{{$media->getFullUrl()}}" >
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="w-full">
            <table class="table-auto">
                <h2 class="bg-green-dark">فروشندگان</h2>
                <th>
                    <td>ردیف</td>
                    <td>لوگو</td>
                    <td>نام</td>
                    <td>ادرس</td>
                </th>
                @forelse($product->businesses as $business)
                <tr class="table-row">
                    <td>{{ $loop->index+1 }}</td>
                    <td><img class="w-1/4" src="{{ $business->getFirstMediaUrl(enum('media.business.logo')) }}" alt=""></td>
                    <td><a href="{{ route('businesses.show', $business->slug) }}">{{ $business->brand }}</a></td>
                    <td>{{ $business->address }}</td>
                </tr>
                @empty
                    این محصول هیچ فروشنده ای ندارد.
                @endforelse
            </table>
        </div>
        <div class="w-full">
            <table class="table-auto">
                <h2 class="bg-green-dark">انواع مختلف محصول</h2>
                <th>
                <td>ردیف</td>
                <td>قیمت</td>
                <td>افزودن به کارت</td>
                </th>
                @forelse($product->relatedVariations as $variation)
                    <tr class="table-row">
                        <td>{{ $loop->index+1 }}</td>
                        <td><img class="w-1/4" src="{{ $business->getFirstMediaUrl(enum('media.business.logo')) }}" alt=""></td>
                        <td><a href="{{ route('businesses.show', $business->slug) }}">{{ $business->brand }}</a></td>
                    </tr>
                    @empty
                        این محصول هیچ فروشنده ای ندارد.
                    @endforelse
                </table>
            </div>
            <div class="w-full">
                <table class="table-auto">
                    <h2 class="bg-green-dark">انواع مختلف محصول</h2>
                    <th>
                    <td>ردیف</td>
                    <td>قیمت</td>
                    <td>افزودن به کارت</td>
                    </th>
                    @forelse($product->relatedVariations as $variation)
                        <tr class="table-row">
                            <td>{{ $loop->index+1 }}</td>
                            <td>@toman($variation->price)</td>
                            <td>
                                <a href="{{ route('cart.store', $variation) }}">
                                    افزودن به سبد خرید
                                </a>
                            </td>
                        </tr>
                    @empty
                        این محصول هیچ فروشنده ای ندارد.
                    @endforelse
                </table>
            </div>
            <div class="w-full">
                {{$product->body}}
            </div>
            <div class="w-full">
                <h3 class="bg-blue-dark">محصولات مرتبط</h3>
                <div class="swiper simple overflow-hidden" column="5" >
                    <div class="swiper-wrapper">
                        @foreach ($product->related() as $product)
                            <div class="swiper-slide">
                                <div class="bg-white swiper-slide px-2">
                                    <a href="{{route('products.show', $product->slug)}}">
                                        <img src="{{$product->getFirstMedia(enum('media.product.banner'))->getFullUrl()}}" alt="">
                                        {{$product->title}}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="w-full">
                <h3 class="bg-red-light">نظرات</h3>
                <ol>
                    @forelse($product->comments as $comment)
                        <li> {{ $comment->body }}</li>
                    @empty
                        اولین کسی باشید که برای این محضول نظر میدهد.
                    @endforelse
                </ol>
            </div>
        </div>
    </div>
@endsection