<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @include('admin.styles')


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.navbar')
        @include('admin.sidebar')

        <div class="content-wrapper">

            <div class="container">
                <h2>Products</h2>
                <!-- Form to Add Product -->
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="product_name">Product Name:</label>
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_id">Select Company:</label>
                        <select name="company_id" class="form-control" required>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="categoryID">Select Category:</label>
                        <select name="categoryID" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price">Price:</label>
                        <input type="text" name="price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="discount_price">Discount Price:</label>
                        <input type="text" name="discount_price" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control"  placeholder="Enter the product description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="featured">Featured Product:</label>
            <input type="checkbox" name="featured" id="featured">
                    </div>

                    <div class="mb-3">
                        <label for="recent">Recent Product:</label>
            <input type="checkbox" name="recent" id="recent">
                    </div>
                    <div class="mb-3">
    <label for="qty">Quantity:</label>
    <input type="number" name="qty" class="form-control" min="1" value="1">
</div>
                    <div class="mb-3">
                        <label for="color">Color:</label>
                        <input type="text" name="color" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keywords (separated by commas)</label>
                        <input class="form-control" name="keywords" />
                    </div>
                    <div class="mb-3">
                        <label for="images">Product Thumbnail:</label>
                        <input type="file" class="form-control-file" id="thumb" name="thumb">
                    </div>
                    <div class="mb-3">
                        <label for="images">Product Images:</label>
                        <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>



        </div>
      </div>

</div>
    @include('admin.footer')
    @include('admin.scripts')
</body>
</html>
<script>
    var input1 = document.querySelector("#kt_tagify_1");
    new Tagify(input1);
</script>
