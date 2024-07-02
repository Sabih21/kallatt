

<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recents Products</span></h2>
    <div class="row px-xl-5">

        @foreach($recentProduct as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden" style="width: 100%; height: 300px;"> <!-- Set your preferred dimensions -->

                        <img class="img-fluid w-100 h-100" src="{{ asset('storage/' . $product->thumb) }}" alt="Product Image">

                        <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href="{{ route('product.details', ['productId' => $product->id]) }}"><i class="fa fa-info-circle"></i>

                        </a>
                        <form id="add_to_cart_form" action="{{ url('add_cart', $product->id) }}" method="POST">
                            @csrf
                            <a href="#" class="btn btn-outline-dark btn-square" onclick="document.getElementById('add_to_cart_form').submit(); return false;">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </form>

                    </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="{{ route('product.details', ['productId' => $product->id]) }}">
                            {{ $product->product_name }}
                        </a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{ $product->price }}</h5><h6 class="text-muted ml-2"><del>PKR {{ $product->discount_price}}</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <!-- Display star ratings and reviews count here -->
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center mt-4">
        <a href="{{url('recent/products')}}" class="btn btn-primary btn-lg">See All Products</a>
    </div>
</div>


