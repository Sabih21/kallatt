<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Bill</title>
    <!-- Include any necessary CSS styles here -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .invoice-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }   
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <h1>Invoice Bill</h1>
                                                                          
        <table>
            <tbody>
                <tr>
                    <th>Name:</th>
                    <td>{{ $order->name }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $order->email }}</td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td>{{ $order->phone }}</td>
                </tr>
                <tr>
                    <th>Product Name:</th>
                    <td>{{ $order->product_name }}</td>
                </tr>
                <tr>
                    <th>Company Name:</th>
                    <td>{{ $order->company_name }}</td>
                </tr>
                <tr>                                            
                    <th>Price:</th>
                    <td>{{ $order->price }}</td>
                </tr>
                <tr>
                    <th>Quantity:</th>
                    <td>{{ $order->quantity }}</td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td>{{ $order->address }}</td>
                </tr>
                <tr>
                    <th>Delivery Status:</th>
                    <td>{{ $order->delivery_status }}</td>
                </tr>
                <tr>
                    <th>Payment Status:</th>
                    <td>{{ $order->payment_status }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
