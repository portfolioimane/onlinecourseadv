@extends('backend.layouts.admin')

@section('content')
<div class="container">
    <h1>Payments</h1>
    <a href="{{ route('admin.payments.create') }}" class="btn btn-primary mb-3">Create Payment</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Enrollment</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->enrollment->id ?? 'N/A' }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>
                        <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $payments->links() }}
</div>
@endsection
