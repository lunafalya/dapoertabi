<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-custom-theme p-4">
            
            <div class="modal-header border-0 pb-3 px-3">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body px-3 py-0">
                    <div class="row">
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div class="mb-2">
                                <img id="edit-modal-image-preview" src="" 
                                     alt="Preview" class="img-fluid rounded" 
                                     style="width: 100%; height: 200px; object-fit: cover; background-color: #FDF6E3;">
                            </div>
                            <label class="form-label d-block text-start mb-2" style="font-size: 0.85rem;">Upload Photo</label>
                            
                            <input type="file" class="d-none" id="edit-modal-photo" name="photo" 
                                   accept="image/*" onchange="previewModalImage(event, 'edit-modal-image-preview')">
                            
                            <button type="button" class="btn-choose-file" onclick="document.getElementById('edit-modal-photo').click();">
                                Choose File <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>

                        <div class="col-md-7">
                            <div class="mb-3">
                                <label for="edit-modal-name" class="form-label fw-medium">Name</label>
                                <input type="text" class="form-control" id="edit-modal-name" name="name" required style="border-radius: 0.3rem;">
                            </div>
                            
                            <div class="mb-3">
                                <label for="edit-modal-category" class="form-label fw-medium">Category</label>
                                <select class="form-select" id="edit-modal-category" name="category" required style="border-radius: 0.3rem;">
                                    <option value="" selected disabled>Select Category</option>
                                    <option value="kuker">Kue Kering</option>
                                    <option value="donut">Donut</option>
                                    <option value="pizza">Pizza</option>
                                    <option value="kue">Kue</option>
                                    <option value="bomboloni">bomboloni</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <input type="text" class="form-control" id="edit-modal-type" name="type" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" id="edit-modal-price" name="price" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" id="edit-modal-description" name="description" rows="4"></textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-3">
                                <button type="submit" class="modal-btn-action btn-brown-pill">Update</button>
                                <button type="button" class="modal-btn-action btn-red-pill" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>