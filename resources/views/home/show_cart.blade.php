


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

@include('home.topbar');

{{-- @include('home.navbar'); --}}


@if(session('message'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    {{ session('message') }}
</div>
@endif

    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Company Name</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php $totalprice = 0; ?>
                        @foreach($cart as $cartItem)
                            <tr>
                                <td class="align-middle">
                                    <img src="{{ asset('storage/' . $cartItem->image_path) }}" alt="{{ $cartItem->product_name }}" style="width: 50px;">
                                    {{ $cartItem->product_name }}
                                </td>
                                <td class="align-middle">{{ $cartItem['company_name'] }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            {{-- <button class="btn btn-sm btn-primary btn-minus" type="button">
                                                <i class="fa fa-minus"></i>
                                            </button> --}}
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $cartItem->quantity }}">
                                        <div class="input-group-btn">
                                            {{-- <button class="btn btn-sm btn-primary btn-plus" type="button">
                                                <i class="fa fa-plus"></i>  
                                            </button> --}}
                                        </div>
                                    </div>  
                                </td>
                                <td class="align-middle">PKR {{ $cartItem->price }}</td>
                                <td class="align-middle">
                                    <form action="{{ url('remove_cart', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php $totalprice += $cartItem->price; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-lg-4">
               
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    {{-- <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>$150</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div> --}}
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>PKR {{$totalprice}}</h5>
                        </div>
                        <a href="{{url('cash_order')}}" class="btn btn-warning mt-2" >Cash on Delivery</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
    



@include('home.footer')

     <!-- Back to Top -->
     <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

     <!-- JavaScript Libraries -->
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






