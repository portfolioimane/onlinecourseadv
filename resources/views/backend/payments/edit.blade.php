@extends('backend.layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Payment</h1>
    
    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="enrollment_id">Enrollment</label>
            <select id="enrollment_id" name="enrollment_id" class="form-control" required>
                @foreach($enrollments as $enrollment)
                    <option value="{{ $enrollment->id }}" {{ $payment->enrollment_id == $enrollment->id ? 'selected' : '' }}>
                        {{ $enrollment->id }}
                    </option>
                @endforeach
            </select>
            @error('enrollment_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount', $payment->amount) }}" step="0.01" required>
            @error('amount')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="unpaid" {{ $payment->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
