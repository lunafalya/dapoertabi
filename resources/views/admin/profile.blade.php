@extends('layouts.admin')
@php
    $user = Auth::user();
@endphp


@section('content')

<div class="card card-content-bg p-5">
    
    <h1 class="fw-bold mb-5">Profile</h1>
    
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="d-flex flex-column align-items-start">
                    
                    <div class="profile-photo-wrapper mb-3">
                    @if($user && $user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" width="150" height="150" style="border-radius:50%;object-fit:cover;">
                    @else
                    @endif
                    </div>
                    
                    <p class="fw-medium mb-2">Upload Photo</p>
                    
                    <label for="profile_photo" class="btn btn-choose-file d-flex align-items-center justify-content-center" 
                           style="background-color: #fcd881; color: #333; font-weight: bold; padding: 0.5rem 1.5rem; border-radius: 0.5rem; cursor: pointer;">
                        Choose File 
                        <i class="fas fa-arrow-right ms-2"></i>
                        <input type="file" id="profile_photo" name="profile_photo" style="display: none;">
                    </label>
                    
                </div>
            </div>
            
            <div class="col-lg-8">
                
                <div class="mb-4">
                    <label for="name" class="form-label visually-hidden">Name</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Name" value="{{ $user->name }}">
                </div>
                
                <div class="mb-4">
                    <label for="email" class="form-label visually-hidden">Email</label>
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}">
                    </div>
                </div>
                
                <div class="mb-5">
                    <label for="phone" class="form-label visually-hidden">Phone</label>
                    <input type="tel" class="form-control form-control-lg" id="phone" name="phone" placeholder="Phone" value="{{ $user->phone }}">
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <button type="submit" class="btn btn-lg me-3" 
                            style="background-color: #fcd881; color: #333; font-weight: bold; border-radius: 0.5rem;">
                        Update
                    </button>
                    
                    <button type="button" class="btn btn-lg text-white" 
                            style="background-color: #ff0000; font-weight: bold; border-radius: 0.5rem;">
                        Cancel
                    </button>
                </div>
  
            </div>
        </div>
    </form>
    
</div>

@endsection