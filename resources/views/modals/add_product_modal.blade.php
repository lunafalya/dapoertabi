<style>
    .modal-custom-theme {
        background-color: #FFFFFF;
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }
    .modal-custom-theme .modal-title {
        color: #3E2723; /* Dark brown */
        font-family: 'Abhaya Libre', serif;
        font-size: 1.8rem;
        font-weight: 700;
    }
    .modal-custom-theme .form-label {
        color: #7A5B40;
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }
    .modal-custom-theme .form-control {
        background-color: #FFFFFF;
        border: 1px solid #8B6A4B; /* Brown border */
        border-radius: 6px;
        color: #3E2723;
        padding: 0.5rem 0.8rem;
    }
    .modal-custom-theme .form-control:focus {
        box-shadow: 0 0 0 2px rgba(139, 106, 75, 0.2);
        border-color: #5C4334;
        outline: none;
    }
    
    /* Custom File Upload Button */
    .btn-choose-file {
        background-color: #E5C17C; /* Yellowish tan */
        color: #FFFFFF;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: opacity 0.2s;
    }
    .btn-choose-file:hover {
        opacity: 0.9;
        color: #FFFFFF;
    }

    /* Bottom Action Buttons */
    .modal-btn-action {
        border-radius: 50px; /* Pill shape */
        padding: 6px 30px;
        font-weight: 600;
        color: #FFFFFF;
        border: none;
        transition: opacity 0.2s;
    }
    .modal-btn-action:hover { opacity: 0.9; color: #FFFFFF; }
    .btn-brown-pill { background-color: #8B6A4B; }
    .btn-red-pill { background-color: #D32F2F; }
</style>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-custom-theme p-4">
            
            <div class="modal-header border-0 pb-3 px-3">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body px-3 py-0">
                    <div class="row">
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div class="mb-2">
                                <img id="add-modal-image-preview" src="https://via.placeholder.com/300x250?text=+" 
                                     alt="Preview" class="img-fluid rounded" 
                                     style="width: 100%; height: 200px; object-fit: cover; background-color: #FDF6E3;">
                            </div>
                            <label class="form-label d-block text-start mb-2" style="font-size: 0.85rem;">Upload Photo</label>
                            
                            <input type="file" class="d-none" id="add-modal-photo" name="photo" 
                                   accept="image/*" onchange="previewModalImage(event, 'add-modal-image-preview')" required>
                            
                            <button type="button" class="btn-choose-file" onclick="document.getElementById('add-modal-photo').click();">
                                Choose File <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>

                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <div class="position-relative">
                                <select id="add-modal-category" name="category" class="form-control" name="category" required style="padding-right: 30px;">
                                    <option value="" selected disabled>Select Category</option>
                                    <option value="kuker">Kue Kering</option>
                                    <option value="donut">Donut</option>
                                    <option value="pizza">Pizza</option>
                                    <option value="kue">Kue</option>
                                    <option value="bomboloni">bomboloni</option>
                                </select>
                                    <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #D3C3B3; font-size: 0.8rem; pointer-events: none;">v</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <input type="text" class="form-control" name="type" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="4"></textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-3">
                                <button type="submit" class="modal-btn-action btn-brown-pill">Add</button>
                                <button type="button" class="modal-btn-action btn-red-pill" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>