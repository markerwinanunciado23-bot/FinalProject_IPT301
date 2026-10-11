
@extends('layouts.app')

@section('title', 'View Laboratory')

@section('content')
<h2 class="fw-bold mb-3">Laboratory Details</h2>

<div class="card page-card">
    <div class="card-body p-4">
        <p><strong>Name:</strong> {{ $laboratory->name }}</p>
        <p><strong>Building:</strong> {{ $laboratory->building }}</p>
        <p><strong>Room:</strong> {{ $laboratory->room_number }}</p>
        <p><strong>Capacity:</strong> {{ $laboratory->capacity }}</p>
        <p><strong>Description:</strong> {{ $laboratory->description ?: '—' }}</p>
        <p><strong>Status:</strong> {{ $laboratory->status }}</p>

        <a href="{{ route('laboratories.edit', $laboratory) }}"
           class="btn btn-primary">Edit</a>
        <a href="{{ route('laboratories.index') }}"
           class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
