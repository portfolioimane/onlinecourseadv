@extends('frontend.layouts.app')

@section('title', 'Payment')

@section('content')
    <h1>Payment for {{ $course->title }}</h1>
    <form action="{{ route('frontend.payments.store', $course) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="amount">Amount (MAD)</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select class="form-control" id="payment_method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <!-- Add more payment methods as needed -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
@endsection
