@extends('layouts.admin')
@php
    $user = Auth::user();
@endphp


@section('content')

<style>
    /* Main Container */
    .profile-container {
        background-color: #FFFFFF;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        padding: 40px;
        max-width: 1000px; /* Keeps the form from stretching too wide on huge screens */
    }

    /* Typography */
    .page-title {
        font-family: 'Playfair Display', 'Times New Roman', serif;
        color: #5C4334;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .system-font {
        font-family: system-ui, -apple-system, sans-serif;
    }
    .text-brown { color: #5C4334; }
    .text-light-brown { color: #A69485; }

    /* Form Inputs */
    .form-control-custom {
        background-color: #F8F5F0;
        border: 1px solid #EADFC8;
        border-radius: 8px;
        padding: 14px 20px;
        color: #5C4334;
        font-family: system-ui, -apple-system, sans-serif;
        font-size: 1rem;
        transition: border-color 0.2s, box-shadow 0.2s;
        width: 100%;
    }
    .form-control-custom:focus {
        background-color: #FFFFFF;
        border-color: #8B6A4B;
        box-shadow: 0 0 0 3px rgba(139, 106, 75, 0.1);
        outline: none;
    }
    .form-control-custom::placeholder {
        color: #A69485;
    }
    .form-label-custom {
        color: #5C4334;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.95rem;
        font-family: system-ui, -apple-system, sans-serif;
        display: block;
    }

    /* Image Upload Area */
    .profile-photo-wrapper {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        border: 4px solid #FDFBF7;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        background-color: #EADFC8;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    .profile-photo-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .profile-photo-wrapper i {
        font-size: 3.5rem;
        color: #FFFFFF;
    }

    /* Buttons */
    .btn-upload {
        background-color: #F0EAE1;
        color: #5C4334;
        border: none;
        border-radius: 50px;
        padding: 8px 24px;
        font-weight: 600;
        transition: all 0.2s;
        font-size: 0.9rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
    }
    .btn-upload:hover {
        background-color: #EADFC8;
    }
    
    .btn-update {
        background-color: #5C4334;
        color: #FFFFFF;
        border-radius: 50px;
        padding: 12px 36px;
        font-weight: 600;
        border: none;
        transition: background-color 0.2s;
        font-family: system-ui, -apple-system, sans-serif;
    }
    .btn-update:hover {
        background-color: #8B6A4B;
        color: #FFFFFF;
    }

    .btn-cancel {
        background-color: transparent;
        color: #A69485;
        border: 1px solid #EADFC8;
        border-radius: 50px;
        padding: 12px 36px;
        font-weight: 600;
        transition: all 0.2s;
        font-family: system-ui, -apple-system, sans-serif;
        text-decoration: none;
    }
    .btn-cancel:hover {
        background-color: #F8F5F0;
        color: #5C4334;
        border-color: #A69485;
    }
</style>


<div class="col-12">
    <div class="profile-container">
        
        <div class="mb-5">
            <h2 class="page-title">Profile Settings</h2>
            <p class="text-light-brown system-font">Manage your account details and profile photo.</p>
        </div>
        
        <form action="{{ route('admin.profile.update') ?? '#' }}" method="POST" enctype="multipart/form-data" class="system-font">
            @csrf
            
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0 d-flex flex-column align-items-center align-items-lg-start">
    
                    <div class="profile-photo-wrapper" id="photoWrapper">
                        @if($user && $user->profile_photo)
                            <img id="photoPreview" src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo">
                        @else
                            <i id="defaultIcon" class="fas fa-user"></i>
                            <img id="photoPreview" src="" alt="Profile Photo" style="display: none;">
                        @endif
                    </div>
                    
                    <label for="profile_photo" class="btn-upload">
                        <i class="fas fa-camera me-2"></i> Choose File 
                        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" style="display: none;">
                    </label>
                    <small class="text-light-brown mt-3 text-center text-lg-start" style="font-size: 0.8rem;">Allowed JPG, GIF or PNG. Max size of 2MB.</small>
                    
                </div>
                
                <div class="col-lg-8">
                    
                    <div class="mb-4">
                        <label for="name" class="form-label-custom">Full Name</label>
                        <input type="text" class="form-control-custom" id="name" name="name" placeholder="Enter your full name" value="{{ $user->name ?? 'Admin' }}">
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="form-label-custom">Email Address</label>
                        <input type="email" class="form-control-custom" id="email" name="email" placeholder="Enter your email" value="{{ $user->email ?? 'admin@example.com' }}">
                    </div>
                    
                    <div class="mb-5">
                        <label for="phone" class="form-label-custom">Phone Number</label>
                        <input type="tel" class="form-control-custom" id="phone" name="phone" placeholder="Enter phone number" value="{{ $user->phone ?? '' }}">
                    </div>

                    <div class="d-flex gap-3 mt-4 pt-3" style="border-top: 1px solid #F0EAE1;">
                        <button type="submit" class="btn-update">Save Changes</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn-cancel d-flex align-items-center">Cancel</a>
                    </div>
    
                </div>
            </div>
        </form>
        
    </div>
</div>

<script>
    document.getElementById('profile_photo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            // Create a file reader to read the image data
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Find our image tag and icon
                const previewImage = document.getElementById('photoPreview');
                const defaultIcon = document.getElementById('defaultIcon');
                
                // If the default icon is showing, hide it
                if (defaultIcon) {
                    defaultIcon.style.display = 'none';
                }
                
                // Set the image source to the file we just picked and make it visible
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            }
            
            // Trigger the reader
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection