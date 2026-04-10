@extends('layouts.admin')
@php
    $user = Auth::user();
@endphp

@section('content')

<div class="card mb-5 card-content-bg p-4">
    
    <h1 class="fw-bold mb-4">MESSAGE</h1>
    
    <div class="d-flex align-items-center mb-4">
        
    </div>

    <table class="table table-hover mb-0 align-middle">
            <tbody>
                <div class="review-list">
                    @foreach ($messages as $message)
                        <div class="d-flex border-bottom py-3 align-items-center">
                            <img src="{{ asset('storage/' . ($message->user->profile_photo ?? 'img/image.png')) }}"
                                alt="User Image"
                                class="rounded-circle me-3"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            
                            <div>
                                <p class="fw-medium mb-1">{{ $message->name }}</p>
                                <small class="d-block mb-1 text-muted">{{ $message->email }}</small>  
                                <p class="mb-0 small text-dark">{{ $message->message }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </tbody>
            </table>
            
</div>
@endsection

