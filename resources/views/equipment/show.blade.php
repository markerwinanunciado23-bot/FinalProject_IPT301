
@extends('layouts.app')

@section('title', 'View Equipment')

@section('content')
<h2 class="fw-bold mb-3">Equipment Details</h2>

<div class="card page-card">
    <div class="card-body p-4">
        <p><strong>Name:</strong> {{ $item->name }}</p>
        <p><strong>Asset Code:</strong> {{ $item->asset_code }}</p>
        <p><strong>Category:</strong> {{ $item->category }}</p>
        <p><strong>Laboratory:</strong> {{ $item->laboratory->name }}</p>
        <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
        <p><strong>Condition:</strong> {{ $item->condition }}</p>
        <p><strong>Status:</strong> {{ $item->status }}</p>

        <a href="{{ route('equipment.edit', $item) }}"
           class="btn btn-primary">Edit</a>
        <a href="{{ route('equipment.index') }}"
           class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
