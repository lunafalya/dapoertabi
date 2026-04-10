@extends('layouts.admin')
@php
    $user = Auth::user();
@endphp

@section('content')

<style>
    /* Page Specific Styles */
    .services-header-title {
        color: #A67C52; /* Golden/Brownish text to match the mockup */
        font-family: 'Abhaya Libre', serif;
        font-weight: 700;
        font-size: 2rem;
    }

    .btn-add-custom {
        background-color: #9E7B5A;
        color: #FFFFFF;
        border-radius: 8px;
        padding: 8px 24px;
        border: none;
        font-weight: 600;
        transition: background-color 0.2s;
    }

    .btn-add-custom:hover {
        background-color: #7A5B40;
        color: #FFFFFF;
    }

    /* Product Card Styling */
    .product-card {
        background-color: #FFFCF8;
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .product-card-body {
        padding: 16px 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .product-title {
        color: #5C4334;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 2px;
    }

    .product-price {
        color: #A69485;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .product-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: auto; /* Pushes the icons to the bottom */
    }

    .action-btn {
        background: none;
        border: none;
        color: #694F3C;
        font-size: 1.15rem;
        padding: 0;
        transition: color 0.2s;
    }

    .action-btn:hover {
        color: #A67C52;
    }
</style>

<div class="col-12 px-0">
    
    <div class="d-flex justify-content-between align-items-center mb-4 pt-2">
        <h1 class="services-header-title mb-0">My Products</h1>
    
        <button type="button" class="btn btn-add-custom" 
           data-bs-toggle="modal" data-bs-target="#addProductModal">
            Add +
        </button>
    </div>
    
    <div class="row">
        @forelse ($products as $product)
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="product-card">
                
                <img src="{{ asset('storage/' . $product->file_path) }}" alt="{{ $product->name }}">
                
                <div class="product-card-body">
                    <h5 class="product-title">{{ $product->name }}</h5>
                    <p class="product-price">Start from Rp.{{ number_format($product->price, 0, ',', '.') }}</p>
                    
                    <div class="product-actions">
                    
                            <button 
                                class="btn btn-sm btn-warning btn-edit-product"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-category="{{ $product->category }}"
                                data-type="{{ $product->type }}"
                                data-price="{{ $product->price }}"
                                data-description="{{ $product->description }}"
                                data-photo="{{ $product->file_path ? asset('storage/'.$product->file_path) : '' }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editProductModal"
                            >
                                Edit
                            </button>
              
                        
                        <form action="{{ route('admin.products.destroy', $product->id) }}" 
                            method="POST" 
                            class="d-inline m-0 p-0"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE') 
                            <button type="submit" class="action-btn" title="Delete">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-muted" style="color: #A69485 !important;">No product available. Click "Add +" to create one.</p>
        </div>
        @endforelse
    </div>
</div>

@include('modals.add_product_modal')
@include('modals.edit_product_modal')

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
      $(document).ready(function() {

    $('.btn-edit-product').on('click', function() {

        var id = $(this).data('id');

        // set action form
        $('#editProductForm').attr('action', '/admin/products/' + id);

        // isi field
        $('#edit-modal-name').val($(this).data('name'));
        $('#edit-modal-category').val($(this).data('category'));
        $('#edit-modal-type').val($(this).data('type'));
        $('#edit-modal-price').val($(this).data('price'));
        $('#edit-modal-description').val($(this).data('description'));
        $('#edit-modal-image-preview').attr('src', $(this).data('photo'));

    });

    
        $('#addProductModal').on('show.bs.modal', function (event) {
            var modal = $(this);
            modal.find('form').trigger('reset');
            modal.find('input[name="_method"]').remove();
            modal.find('#add-modal-image-preview').attr('src', 'https://via.placeholder.com/250x180?text=Preview');
        });

        window.previewModalImage = function(event, previewId) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById(previewId);
                output.src = reader.result;
                output.style.objectFit = 'cover'; 
            };
            if (event.target.files.length > 0) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.delete-btn');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');

            // Pop-up konfirmasi
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                fetch(`/admin/products/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hapus elemen dari view tanpa reload
                        this.closest('tr').remove(); // Note: Changed to div context in UI but kept script logic safe

                        // Notifikasi sukses
                        alert('Product deleted successfully!');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
</script>
@yield('scripts')
@endsection