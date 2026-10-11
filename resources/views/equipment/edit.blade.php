
@extends('layouts.app')

@section('title', 'Edit Equipment')

@section('content')
<h2 class="fw-bold mb-3">Edit Equipment</h2>

<div class="card page-card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('equipment.update', $item) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Laboratory</label>
                <select name="laboratory_id" class="form-select" required>
                    @foreach($laboratories as $laboratory)
                        <option value="{{ $laboratory->id }}"
                            @selected(old('laboratory_id', $item->laboratory_id) == $laboratory->id)>
                            {{ $laboratory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Equipment Name</label>
                <input name="name" class="form-control"
                       value="{{ old('name', $item->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Asset Code</label>
                <input name="asset_code" class="form-control"
                       value="{{ old('asset_code', $item->asset_code) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <input name="category" class="form-control"
                       value="{{ old('category', $item->category) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" min="1" name="quantity"
                       class="form-control"
                       value="{{ old('quantity', $item->quantity) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Condition</label>
                <select name="condition" class="form-select" required>
                    @foreach(['Excellent', 'Good', 'Fair', 'Poor', 'Damaged'] as $condition)
                        <option value="{{ $condition }}"
                            @selected(old('condition', $item->condition) === $condition)>
                            {{ $condition }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    @foreach(['Available', 'Reserved', 'Under Maintenance', 'Retired'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', $item->status) === $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Update Equipment</button>
            <a href="{{ route('equipment.index') }}"
               class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
