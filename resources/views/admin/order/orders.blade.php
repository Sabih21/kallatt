<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @include('admin.styles')

    <style>
        th,
        td {

            font-weight: bold;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.navbar')
        @include('admin.sidebar')
        <div class="content-wrapper">



            <div class="container-fluid">

                <h2>All Orders</h2>

                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Product Name</th>
                            <th>Company</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Delivery Address</th>
                            <th>City</th>
                            <th>Shop</th>
                            <th>Delivery Status</th>
                            <th>Payment Status</th>
                            <th>Image</th>
                            <th>Delivered</th>
                            <th>Print PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->company_name }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->city }}</td>
                                <td>{{ $order->shop }}</td>
                                <td>{{ $order->delivery_status }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>
                                    <img style="width: 70px; height:70px;"
                                        src="{{ asset('storage/' . $order->image_path) }}" alt="Product Image">
                                </td>

                                <td>
                                    @if ($order->delivery_status == 'processing')
                                        <a href="{{ url('delivered', $order->id) }}"
                                            onclick="return confirm('Are you sure the Product is delivered!')"
                                            class="btn btn-primary">Delivered</a>
                                    @else
                                        <b>
                                            <p style="color:rgb(8, 121, 6); font-size:20px">Delivered</p>
                                        </b>
                                    @endif
                                </td>
                                
                                <td>
                                    <a href="{{url('print_pdf' , $order->id)}}" class="btn btn-secondary">Print PDF</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>










            </div>
        </div>
        @include('admin.footer')
        @include('admin.scripts')
</body>

</html>
