@extends('client.layout.master_layout')

@push('style')
<style>
    .cart-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .cart-item {
        display: flex;
        gap: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background-color: #f9f9f9;
    }

    .cart-item-image img {
        max-width: 150px;
        border-radius: 8px;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-title {
        font-size: 1.5em;
        margin: 0;
    }

    .cart-item-price {
        font-size: 1.2em;
        color: #e74c3c;
        margin: 10px 0;
    }

    .cart-item-date {
        font-size: 1em;
        color: #7f8c8d;
    }

    .cart-form {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .cart-item-quantity {
        width: 60px;
    }

    .btn-update, .btn-remove, .btn-checkout {
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 8px 12px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-update:hover, .btn-remove:hover, .btn-checkout:hover {
        background-color: #2980b9;
    }

    .btn-remove {
        background-color: #e74c3c;
    }

    .btn-remove:hover {
        background-color: #c0392b;
    }

    .btn-checkout {
        background-color: #27ae60;
    }

    .btn-checkout:hover {
        background-color: #2ecc71;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1>Cart</h1>

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

    @if($cartItems->count() > 0)
        <div class="cart-container">
            @foreach ($cartItems as $item)
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="{{ asset('storage/' . $item->attributes->image) }}" alt="{{ $item->name }}">
                    </div>
                    <div class="cart-item-details">
                        <h2 class="cart-item-title">{{ $item->name }}</h2>
                        <p class="cart-item-price">Price: ${{ $item->price * $item->quantity }}</p>
                        <p class="cart-item-date">Start Date: {{ $item->attributes->start_date }}</p>
                        <form action="{{ route('cart.update') }}" method="POST" class="cart-form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                        </form>
                        <form action="{{ route('cart.remove') }}" method="POST" class="cart-form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button type="submit" class="btn-remove">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Thêm phần thanh toán -->
        <div class="checkout-container">
            <a href="{{ route('cart.checkout') }}" class="btn-checkout">Proceed to Checkout</a>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
