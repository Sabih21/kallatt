<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Companies</span></h2>
    <div class="row px-xl-5 pb-3">
        @foreach($companies as $company)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <!-- You can use an image from your comp an y d a t a   o r   s e t   a   d e f a ul t  i m ag e -->
                            <img class="img-fluid" style="width:340px; height: 95px"  src="{{ asset('storage/' . $company->image_path) }}" alt="{{ $company->company_name }}">
                        </div>
                        <div class="flex-fill pl-3">
                        <a href="{{ route('show.products.by.company', ['company', $company->id]) }}"><h6>{{ $company->company_name }}</h6></a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
