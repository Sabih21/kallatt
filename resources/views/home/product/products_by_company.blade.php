<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kalat Mobile Accessories</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    @include('home.topbar')
    @include('home.navbar')

    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
        <div class="row px-xl-5">

            @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4" style="width: 80%; height: 80%;">
                        <div class="product-img position-relative overflow-hidden d-flex align-items-center justify-content-center" style="width: 100%; height: 100%;">
                            <img class="img-fluid w-100 h-100" src="{{ asset('storage/' . $product->thumb) }}" alt="Product Image">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href="{{ route('product.details', ['productId' => $product->id]) }}"><i class="fa fa-info-circle"></i></a>
                                {{-- <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a> --}}
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="{{ route('product.details', ['productId' => $product->id]) }}">
                                {{ $product->product_name }}
                            </a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>PKR {{ $product->price }}</h5><h6 class="text-muted ml-2"><del>PKR {{ $product->discount_price }}</del></h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


    @include('home.footer')

<script src="{{ asset('https://code.jquery.com/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Contact Javascript File -->
<script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>
<script src="{{ asset('mail/contact.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
