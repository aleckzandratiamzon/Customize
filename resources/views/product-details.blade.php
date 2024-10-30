@extends('layouts.app5')

@section('contents')
@if(Session::has('success'))
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        // iconColor: 'white',
        customClass: {
            popup: 'colored-toast',
        },
        showCloseButton: true,
        showConfirmButton: false,
        timer: 2500,
        // timerProgressBar: true,
        })
         Toast.fire({
            icon: 'success',
            title: '{{Session::get('success')}}',
        })

    </script>
@endif
<section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>{{$product->title}}</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">{{$product->title}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section> <!-- Shop Section start -->

<section>
    <div class="container">
        <div class="row gx-4 gy-5">
            <div class="col-lg-12 col-12">
                <div class="details-items">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="details-image-vertical black-slide rounded">
                                        {{-- main image --}}
                                        <div>
                                            <img src="{{ asset('images/' . $product->main_image) }}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                        {{-- Start of image gallery --}}
                                        <div id="gallery" class="img-gallery">
    <!-- Images will be dynamically inserted here -->
</div>
                                        <div>
                                            <img src="../assets/images/fashion/2.jpg"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                        <div>
                                            <img src="../assets/images/fashion/3.jpg"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                        <div>
                                            <img src="../assets/images/fashion/4.jpg"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="details-image-1 ratio_asos">
                                        {{-- main image --}}
                                        <div>
                                            <img src="{{ asset('images/' . $product->main_image) }}" id="zoom_01"
                                                data-zoom-image="assets/images/fashion/1.jpg"
                                                class="img-fluid w-100 image_zoom_cls-0 blur-up lazyload" alt="">
                                        </div>
                                        {{-- Start of image gallery --}}
                                        <div id="gallery" class="img-gallery">
    <!-- Images will be dynamically inserted here -->
</div>

                                        <div>
                                            <img src="../assets/images/fashion/2.jpg" id="zoom_02"
                                                data-zoom-image="assets/images/fashion/2.jpg"
                                                class="img-fluid w-100 image_zoom_cls-1 blur-up lazyload" alt="">
                                        </div>
                                        <div>
                                            <img src="../assets/images/fashion/3.jpg" id="zoom_03"
                                                data-zoom-image="assets/images/fashion/3.jpg"
                                                class="img-fluid w-100 image_zoom_cls-2 blur-up lazyload" alt="">
                                        </div>
                                        <div>
                                            <img src="../assets/images/fashion/4.jpg" id="zoom_04"
                                                data-zoom-image="assets/images/fashion/4.jpg"
                                                class="img-fluid w-100 image_zoom_cls-3 blur-up lazyload" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="cloth-details-size">
                                {{-- <div class="product-count">
                                    <ul>
                                        <li>
                                            <img src="../assets/images/gif/fire.gif"
                                                class="img-fluid blur-up lazyload" alt="image">
                                            <span class="p-counter">37</span>
                                            <span class="lang">orders in last 24 hours</span>
                                        </li>
                                        <li>
                                            <img src="../assets/images/gif/person.gif"
                                                class="img-fluid user_img blur-up lazyload" alt="image">
                                            <span class="p-counter">44</span>
                                            <span class="lang">active view this</span>
                                        </li>
                                    </ul>
                                </div> --}}

                                <div class="details-image-concept">
                                    <h2 class="font-medium">{{$product->title}}</h2>
                                </div>

                                <div class="label-section">
                                    <span class="label-text">#1 Best seller in</span>
                                    <span class="badge badge-grey-color"> {{$product->category}}</span>
                                </div>

                                <h3 class="price-detail font-medium">&#8369;{{$product->price}}</h3>


                                <div id="selectSize" class="addeffect-section product-description border-product">
                                    @if ($product->customizable == false)
                                    <form method="POST" action="{{ route('addToCart', $product->id) }}">
                                        @csrf
                                    <h6 class="product-title product-title-2 d-block">quantity</h6>

                                    <div class="qty-box">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-left-minus"
                                                    onclick="updateQuantity()" data-type="minus" data-field="">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="text" name="quantity" id="quantity"
                                                class="form-control input-number" value="1">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-right-plus"
                                                    onclick="updateQuantity()" data-type="plus" data-field="">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-buttons">
                                        <!-- Include your product details here -->

                                        <button type="submit" class="btn btn-solid hover-solid btn-animation">
                                            <i class="fa fa-shopping-cart"></i> <span>Add To Cart</span>
                                        </button>
                                    </form>
                                </div>
                                    @else
                                    <div class="mb-4">
                                        <p class="text-base">You can create a product that truly reflects your style and personality!</p>
                                    </div>
                                <div class="product-buttons">
                                    <button >
                                        <a class="btn btn-solid hover-solid btn-animation" href="{{route('customize', $product->id)}}" >
                                        <i class="bi bi-palette"></i> <span>Customize</span>
                                        </a>
                                    </button>
                                    @endif
                                </div>



                                <div class="mt-2 mt-md-3 border-product">
                                    <h6 class="product-title hurry-title d-block">Hurry Up!<span>{{$product->quantity}}</span> left in
                                        stock</h6>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 78%"></div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="cloth-review">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#desc" type="button">Description</button>

                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="desc">
                            <div class="shipping-chart">
                                <div class="part">
                                    <h4 class="inner-title mb-2">{{$product->title}}</h4>
                                    <p class="font-light">{{$product->description}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section end -->

<!-- product section start -->
<section class="ratio_asos section-b-space overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-lg-4 mb-3 text-lg font-medium">Customers Also Bought These</h2>
                <div class="product-wrapper product-style-2 slide-4 p-0 light-arrow bottom-space">
                    @foreach ($shuffle as $ap)
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="{{route('product-details', $ap->id)}}">
                                        <img src="{{ asset('images/' . $ap->main_image) }}"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <!-- <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="{{route('product-details', $ap->id)}}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </li>

                                    </ul>
                                </div> -->
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">{{$ap->category}}</span>
                                </div>
                                <div class="main-price">
                                    <a href="details.php" class="font-default">
                                        <h5>{{$ap->title}}</h5>
                                    </a>
                                    <h3 class="theme-color">&#8369;{{$ap->price}}</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->


@endsection
