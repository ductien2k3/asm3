@extends('client.layout.master_layout')

@push('style')
<style>
    .checkout-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .checkout-item {
        display: flex;
        gap: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background-color: #f9f9f9;
    }

    .checkout-item-image img {
        max-width: 150px;
        border-radius: 8px;
    }

    .checkout-item-details {
        flex: 1;
    }

    .checkout-item-title {
        font-size: 1.5em;
        margin: 0;
    }

    .checkout-item-price {
        font-size: 1.2em;
        color: #e74c3c;
        margin: 10px 0;
    }

    .checkout-item-date {
        font-size: 1em;
        color: #7f8c8d;
    }

    .checkout-form input {
        margin: 5px 0;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .btn-submit {
        background-color: #27ae60;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 10px 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #2ecc71;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1>Checkout</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="checkout-container">
        @foreach ($cartItems as $item)
            <div class="checkout-item">
                <div class="checkout-item-image">
                    <img src="{{ asset('storage/' . $item->attributes->image) }}" alt="{{ $item->name }}">
                </div>
                <div class="checkout-item-details">
                    <h2 class="checkout-item-title">{{ $item->name }}</h2>
                    <p class="checkout-item-price">Price: ${{ $item->price }}</p>
                    <p class="checkout-item-date">Start Date: {{ $item->attributes->start_date }}</p>
                </div>
            </div>
        @endforeach

        <h2>Total: $<span id="totalAmount">{{ $totalAmount }}</span></h2>

        <form id="paymentForm" action="{{ route('cart.processPayment') }}" method="POST">
            @csrf
            <h2>Payment Details</h2>
            <p>Credit Card Number: <input type="text" name="card_number" placeholder="4242 4242 4242 4242" required></p>
            <p>Expiration Date: <input type="text" name="expiry_date" placeholder="MM/YY" required></p>
            <p>CVV: <input type="text" name="cvv" placeholder="123" required></p>
            <p>Coupon Code: <input type="text" id="couponCode" name="coupon_code" placeholder="Enter your coupon code"></p>
            <button type="button" id="applyCouponButton" class="btn-submit">Apply Coupon</button>
            <button type="submit" class="btn-submit">Pay Now</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('applyCouponButton').addEventListener('click', function() {
    var couponCode = document.getElementById('couponCode').value.trim(); // Sử dụng trim() để loại bỏ khoảng trắng thừa
    var totalAmountElement = document.getElementById('totalAmount');

    if (couponCode === '') {
        alert('Please enter a coupon code.');
        return; // Dừng thực thi nếu mã giảm giá trống
    }

    fetch('{{ route('cart.applyCoupon') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ coupon_code: couponCode })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            var newTotal = parseFloat(totalAmountElement.innerText) - (parseFloat(totalAmountElement.innerText) * (data.discountAmount / 100));
            totalAmountElement.innerText = newTotal.toFixed(2);
            alert('Coupon applied successfully! Discount: ' + data.discountAmount + '%');
        } else {
            alert(data.message);
        }
    });
});
</script>
@endpush

