@extends('layouts.admin')
@php
    $user = Auth::user();
@endphp

@section('content')

<style>
    /* Typography & Titles */
    .services-header-title {
        color: #5C4334; /* Primary Brown */
        font-family: 'Playfair Display', 'Times New Roman', serif !important;
        font-weight: 700;
        font-size: 2.2rem;
    }

    /* Modern Pill Button */
    .btn-add-custom {
        background-color: #5C4334;
        color: #FFFFFF;
        border-radius: 50px; /* Pill shape to match other pages */
        padding: 10px 28px;
        border: none;
        font-weight: 600;
        font-family: system-ui, -apple-system, sans-serif;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(92, 67, 52, 0.1);
    }

    .btn-add-custom:hover {
        background-color: #8B6A4B;
        color: #FFFFFF;
        transform: translateY(-1px);
    }

    /* Product Card Styling */
    .product-card {
        background-color: #FFFCF8;
        border-radius: 16px; /* Increased for a more modern feel */
        overflow: hidden;
        border: 1px solid #F0EAE1;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    }

    .product-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #F0EAE1;
    }

    .product-card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        font-family: system-ui, -apple-system, sans-serif;
    }

    .product-title {
        font-family: 'Playfair Display', serif;
        color: #5C4334;
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 6px;
    }

    .product-price {
        color: #8B6A4B; /* Using the mid-brown accent */
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    /* Action Buttons (Icons) */
    .product-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px dashed #EADFC8;
    }

    .action-btn {
        background-color: #F8F5F0;
        border: none;
        color: #5C4334;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        font-size: 1rem;
    }

    .action-btn:hover {
        background-color: #EADFC8;
        color: #5C4334;
    }
    
    /* Specific styling for delete icon hover */
    form .action-btn:hover {
        background-color: #FFF0F0;
        color: #D32F2F;
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