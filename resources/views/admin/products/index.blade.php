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

                <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
                                                                                                                

                <table class="table mt-3">
                    <thead>
                        <tr>                                
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Company</th>                        
                                <th>Category</th>                        
                                <th>Price</th>
                                <th>Discount Price</th>         
                                <th>Quantity</th>           
                                <th>Color</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>                                                                        
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->company->company_name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->price }}</td>                                      
                                <td>{{ $product->discount_price }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>{{ $product->color }}</td>          

          <td>                         
        @if($product->featured == 1)
        <p>Featured!</p>
    @elseif($product->recent == 1)
        <p>Recent.</p>
        @else
        <p>Normal</p>
    @endif
</td>
                                <td>

                                    @foreach ($product->images as $image)
                                    
                                    <img src="{{ asset('storage/' . $image->image_path) }}" height="50px"
                                     
                                        width="50px" alt="Product Image">
                                    
                                        @endforeach

                                </td>

                                <td>

                                    <a href="{{ route('products.edit', $product->id) }}"

                                        class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="post"

                                        style="display: inline;">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm"

                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>

                                        </form>
                                </td>

                            </tr>

                            @endforeach

                    </tbody>                                                                                                                            
        
                </table>
        
            </div>
        
        </div>

    </div>
    
</div>
    @include('admin.footer')
    @include('admin.scripts')
</body>
</html>
