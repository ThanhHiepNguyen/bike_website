<!-- Add Bike Modal - Advanced UI -->
<div class="modal fade" id="addBikeModal" tabindex="-1" role="dialog" aria-labelledby="addBikeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addBikeModalLabel">
                    <i class="fas fa-bicycle mr-2"></i>Thêm xe mới
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form method="POST" enctype="multipart/form-data" id="addBikeForm">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    
                    <!-- Progress steps -->
                    <div class="steps-container mb-4">
                        <div class="steps">
                            <div class="step active">
                                <div class="step-number">1</div>
                                <div class="step-text">Thông tin</div>
                            </div>
                            <div class="step">
                                <div class="step-number">2</div>
                                <div class="step-text">Hình ảnh</div>
                            </div>
                            <div class="step">
                                <div class="step-number">3</div>
                                <div class="step-text">Xác nhận</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 1: Basic Information -->
                    <div class="step-content active" id="step1">
                        <div class="form-group">
                            <label class="font-weight-bold">Loại xe <span class="text-danger">*</span></label>
                            <div class="bike-type-selector">
                                <div class="bike-type-option" data-value="bike">
                                    <i class="fas fa-bicycle fa-2x mb-2"></i>
                                    <span>Xe đạp thường</span>
                                    <div class="check-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="bike-type-option" data-value="ebike">
                                    <i class="fas fa-bolt fa-2x mb-2"></i>
                                    <span>Xe đạp điện</span>
                                    <div class="check-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="bike_type" id="bikeTypeInput" required>
                        </div>
                    </div>
                    
                    <!-- Step 2: Image Upload -->
                    <div class="step-content" id="step2">
                        <div class="form-group">
                            <label class="font-weight-bold">Hình ảnh xe <span class="text-danger">*</span></label>
                            <div class="image-upload-container">
                                <div class="upload-area" id="uploadArea">
                                    <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                                    <h4>Kéo thả hình ảnh vào đây</h4>
                                    <p>hoặc</p>
                                    <label for="bikeImage" class="btn btn-primary btn-sm">
                                        Chọn file
                                    </label>
                                    <input type="file" name="image" id="bikeImage" class="d-none" accept="image/*" required>
                                    <p class="text-muted mt-2">Chấp nhận: JPG, JPEG, PNG, GIF (Tối đa 5MB)</p>
                                </div>
                                <div class="image-preview" id="imagePreviewContainer" style="display: none;">
                                    <img id="imagePreview" src="#" alt="Preview">
                                    <div class="preview-overlay">
                                        <button type="button" class="btn btn-danger btn-sm" id="removeImage">
                                            <i class="fas fa-trash"></i> Xóa ảnh
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 3: Confirmation -->
                    <div class="step-content" id="step3">
                        <div class="confirmation-summary">
                            <h4 class="mb-4">Xác nhận thông tin</h4>
                            <div class="summary-item">
                                <span class="summary-label">Loại xe:</span>
                                <span id="summaryBikeType" class="summary-value"></span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Hình ảnh:</span>
                                <span id="summaryImage" class="summary-value"></span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Trạng thái ban đầu:</span>
                                <span class="summary-value badge badge-success">Có sẵn</span>
                            </div>
                            <div class="summary-preview mt-3">
                                <img id="summaryImagePreview" src="#" alt="Preview" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="prevStep" style="display: none;">
                        <i class="fas fa-chevron-left mr-2"></i>Quay lại
                    </button>
                    <button type="button" class="btn btn-primary" id="nextStep">
                        Tiếp theo<i class="fas fa-chevron-right ml-2"></i>
                    </button>
                    <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">
                        <i class="fas fa-check mr-2"></i>Hoàn tất
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Modal custom styles */
.modal-lg {
    max-width: 800px;
}

.modal-content {
    border-radius: 15px;
    overflow: hidden;
}

.modal-header {
    border-bottom: none;
    border-radius: 0;
    padding: 1.5rem;
}

/* Steps styles */
.steps-container {
    padding: 0 20px;
}

.steps {
    display: flex;
    justify-content: space-between;
    position: relative;
}

.steps::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 2px;
    background: #e9ecef;
    z-index: 1;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    flex: 1;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.step.active .step-number {
    background: #007bff;
    color: white;
    transform: scale(1.1);
}

.step.completed .step-number {
    background: #28a745;
    color: white;
}

.step-text {
    font-size: 0.9rem;
    color: #6c757d;
    transition: all 0.3s ease;
}

.step.active .step-text {
    color: #007bff;
    font-weight: bold;
}

.step.completed .step-text {
    color: #28a745;
}

/* Step content styles */
.step-content {
    display: none;
    animation: fadeIn 0.3s ease;
}

.step-content.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Bike type selector styles */
.bike-type-selector {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-top: 1rem;
}

.bike-type-option {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.bike-type-option:hover {
    border-color: #007bff;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.bike-type-option.selected {
    border-color: #007bff;
    background-color: #f8f9fa;
}

.bike-type-option i {
    color: #007bff;
}

.bike-type-option span {
    display: block;
    font-weight: 600;
    color: #495057;
}

.check-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    color: #28a745;
    display: none;
}

.bike-type-option.selected .check-icon {
    display: block;
}

/* Image upload styles */
.image-upload-container {
    position: relative;
}

.upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    padding: 2rem;
    text-align: center;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.upload-area:hover {
    border-color: #007bff;
    background-color: #fff;
}

.upload-area.dragover {
    border-color: #007bff;
    background-color: #e3f2fd;
}

.upload-area i {
    color: #6c757d;
}

.image-preview {
    position: relative;
    margin-top: 1rem;
}

.image-preview img {
    max-width: 100%;
    max-height: 300px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.preview-overlay {
    position: absolute;
    top: 10px;
    right: 10px;
}

/* Confirmation summary styles */
.confirmation-summary {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 1.5rem;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #dee2e6;
}

.summary-label {
    font-weight: bold;
    color: #6c757d;
}

.summary-value {
    color: #495057;
}

.summary-preview img {
    max-width: 200px;
    max-height: 200px;
    object-fit: cover;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addBikeForm');
    const steps = document.querySelectorAll('.step');
    const stepContents = document.querySelectorAll('.step-content');
    const prevBtn = document.getElementById('prevStep');
    const nextBtn = document.getElementById('nextStep');
    const submitBtn = document.getElementById('submitBtn');
    const bikeTypeOptions = document.querySelectorAll('.bike-type-option');
    const bikeTypeInput = document.getElementById('bikeTypeInput');
    const imageInput = document.getElementById('bikeImage');
    const uploadArea = document.getElementById('uploadArea');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const imagePreview = document.getElementById('imagePreview');
    const removeImageBtn = document.getElementById('removeImage');
    let currentStep = 1;
    
    // Bike type selection
    bikeTypeOptions.forEach(option => {
        option.addEventListener('click', function() {
            bikeTypeOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            bikeTypeInput.value = this.dataset.value;
        });
    });
    
    // Image upload functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });
    
    uploadArea.addEventListener('drop', handleDrop, false);
    imageInput.addEventListener('change', handleFiles);
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function highlight() {
        uploadArea.classList.add('dragover');
    }
    
    function unhighlight() {
        uploadArea.classList.remove('dragover');
    }
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        imageInput.files = files;
        handleFiles();
    }
    
    function handleFiles() {
        const file = imageInput.files[0];
        if (file) {
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'File ảnh không được vượt quá 5MB'
                });
                imageInput.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                uploadArea.style.display = 'none';
                imagePreviewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }
    
    removeImageBtn.addEventListener('click', function() {
        imageInput.value = '';
        imagePreview.src = '#';
        uploadArea.style.display = 'block';
        imagePreviewContainer.style.display = 'none';
    });
    
    // Step navigation
    nextBtn.addEventListener('click', function() {
        if (validateStep(currentStep)) {
            if (currentStep < 3) {
                currentStep++;
                updateSteps();
            }
        }
    });
    
    prevBtn.addEventListener('click', function() {
        if (currentStep > 1) {
            currentStep--;
            updateSteps();
        }
    });
    
    function validateStep(step) {
        switch(step) {
            case 1:
                if (!bikeTypeInput.value) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Vui lòng chọn loại xe'
                    });
                    return false;
                }
                return true;
            case 2:
                if (!imageInput.files[0]) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Vui lòng chọn hình ảnh'
                    });
                    return false;
                }
                return true;
            default:
                return true;
        }
    }
    
    function updateSteps() {
        // Update step indicators
        steps.forEach((step, index) => {
            if (index + 1 < currentStep) {
                step.classList.add('completed');
                step.classList.remove('active');
            } else if (index + 1 === currentStep) {
                step.classList.add('active');
                step.classList.remove('completed');
            } else {
                step.classList.remove('active', 'completed');
            }
        });
        
        // Update step content
        stepContents.forEach((content, index) => {
            if (index + 1 === currentStep) {
                content.classList.add('active');
            } else {
                content.classList.remove('active');
            }
        });
        
        // Update buttons
        prevBtn.style.display = currentStep === 1 ? 'none' : 'inline-block';
        nextBtn.style.display = currentStep === 3 ? 'none' : 'inline-block';
        submitBtn.style.display = currentStep === 3 ? 'inline-block' : 'none';
        
        // Update summary if on step 3
        if (currentStep === 3) {
            document.getElementById('summaryBikeType').textContent = 
                bikeTypeInput.value === 'bike' ? 'Xe đạp thường' : 'Xe đạp điện';
            document.getElementById('summaryImage').textContent = 
                imageInput.files[0] ? imageInput.files[0].name : '';
            document.getElementById('summaryImagePreview').src = imagePreview.src;
        }
    }
    
    // Form submission - Fixed to work with index.php
    form.addEventListener('submit', function(e) {
        // Don't prevent default - let the form submit normally to index.php
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang xử lý...';
    });
    
    // Reset form when modal is hidden
    $('#addBikeModal').on('hidden.bs.modal', function () {
        form.reset();
        currentStep = 1;
        updateSteps();
        bikeTypeOptions.forEach(opt => opt.classList.remove('selected'));
        imageInput.value = '';
        imagePreview.src = '#';
        uploadArea.style.display = 'block';
        imagePreviewContainer.style.display = 'none';
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Hoàn tất';
    });
});
</script>