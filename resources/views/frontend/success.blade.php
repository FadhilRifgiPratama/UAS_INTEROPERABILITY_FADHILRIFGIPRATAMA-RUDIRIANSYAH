<!-- resources/views/frontend/checkout_success.blade.php -->

@extends('frontend.layouts.main')

@section('content')
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-5">
                        <div class="card-header bg-success text-white">
                            <h1 class="mb-4 mt-4 text-light text-center">Order Successful!</h1>
                        </div>

                        <div class="card-body">
                            @if($transaction)
                                <div class="alert alert-success row text-center" role="alert">
                                    <i class="fas fa-check-circle fa-4x me-2 mb-2"></i>
                                    <div>
                                        <h4 class="alert-heading">Thank you for your order!</h4>
                                        <p>Your order details:</p>
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Transaction ID:</strong> {{ $transaction->id }}</li>
                                            <li class="list-group-item"><strong>Address:</strong> {{ $transaction->address }}</li>
                                            <li class="list-group-item"><strong>Town/City:</strong> {{ $transaction->town_city }}</li>
                                            <li class="list-group-item"><strong>Country:</strong> {{ $transaction->country }}</li>
                                            <li class="list-group-item"><strong>Postcode:</strong> {{ $transaction->postcode }}</li>
                                            <li class="list-group-item"><strong>Phone Number:</strong> {{ $transaction->phone_number }}</li>
                                            <li class="list-group-item"><strong>Order Notes:</strong> {{ $transaction->order_notes ?? 'N/A' }}</li>
                                            <li class="list-group-item"><strong>Product:</strong> {{ $transaction->product->name ?? 'N/A' }}</li>
                                            <li class="list-group-item"><strong>Quantity:</strong> {{ $transaction->quantity ?? 'N/A' }}</li>
                                            <li class="list-group-item"><strong>Subtotal:</strong> Rp.{{ number_format($transaction->subtotal) }}</li>
                                            <li class="list-group-item"><strong>Shipping:</strong> {{ $transaction->shipping ? 'Yes' : 'No' }}</li>
                                            <li class="list-group-item"><strong>Payment Method:</strong> {{ $transaction->payment_method ?? 'N/A' }}</li>
                                            <!-- Add other transaction details as needed -->
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <strong>Error!</strong> No transaction details found.
                                </div>
                            @endif
                        </div>
                        <div class="text-center">
                              <a href="{{ route('homepage') }}" class="btn btn-primary mb-4 text-light">Back To Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
