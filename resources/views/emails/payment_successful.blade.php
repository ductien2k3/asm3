<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
</head>
<body>
    <h1>Payment Successful!</h1>
    <p>Hi {{ $userName }},</p>
    <p>Your payment has been processed successfully. Here are the details of your order:</p>

    <ul>
        @foreach ($cartItems as $item)
            <li>
                <strong>{{ $item->name }}</strong> - ${{ $item->price }}
            </li>
        @endforeach
    </ul>

    <p><strong>Total Amount: ${{ $totalAmount }}</strong></p>

    <p>Thank you for your purchase!</p>
</body>
</html>
