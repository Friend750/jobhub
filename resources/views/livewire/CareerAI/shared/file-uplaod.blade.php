<label class="d-flex flex-column justify-content-center p-3 w-100 h-50 gap-3 custum-file-upload" for="cvInput">
    <div class="icon " x-bind:class="(uploadState === 'error' || errors.cv) ? 'd-none' : ''">
        <i class="fas fa-cloud-upload-alt text-muted" style="font-size: 80px"></i>
    </div>


    <div class="upload-status text-center " x-cloak>
        <!-- All states in one clean structure -->

        <!-- Idle State -->
        <div x-show="uploadState === 'idle' && !errors.cv" class="text-muted">
            <div>ارفع سيرتك الذاتية (PDF)</div>
        </div>

        <!-- Processing States (all use same structure) -->
        <template x-if="['uploading', 'Analyzing', 'Extracting'].includes(uploadState)">
            <div class="text-muted">
                <div class="spinner-border spinner-border-sm mb-2" role="status"></div>
                <div>
                    <span x-show="uploadState === 'uploading'">جاري رفع الملف...</span>
                    <span x-show="uploadState === 'Analyzing'">جاري تحليل الملف...</span>
                    <span x-show="uploadState === 'Extracting'">جاري استخراج البيانات...</span>
                </div>
            </div>
        </template>

        <!-- Success States -->
        <div x-show="uploadState === 'success' || uploadState === 'successfully-analyzed'"
            class="text-success">
            <div>
                <i class="fas fa-check-circle"></i>
                <span x-show="uploadState === 'success'" class="fw-bold">تم رفع الملف بنجاح!</span>
                <span x-show="uploadState === 'successfully-analyzed'">تم تحليل الملف بنجاح!</span>
            </div>
            <div class="small text-muted mt-2">
                <div x-text="uploadedFileName || fileDetails.name"></div>
                <div x-text="uploadedFileSize || fileDetails.size"></div>
            </div>
        </div>

        <!-- Error State -->
        <div x-show="uploadState === 'error' || errors.cv" class="text-danger">
            <i class="fas fa-exclamation-circle " style="font-size: 80px"></i>
            <div class="fw-bold">
                حدث خطأ أثناء رفع الملف
                !
            </div>
            <div class="small text-muted mt-2" x-text="errors.cv"></div>
            <button type="button" x-on:click="retryUpload" class="btn btn-sm btn-outline-dark mt-2">
                <i class="fas fa-redo me-1"></i> إعادة المحاولة
            </button>
        </div>
    </div>



    <style>
        .upload-status {
            transition: all 0.3s ease;
            border-radius: 0.5rem;

        }

        .status-idle {
            color: #6c757d;
        }

        .status-processing {
            color: #6c757d;
            display: flex;
            align-items: center;
        }

        .status-success {
            color: #198754;
        }

        .status-error {
            color: #dc3545;
        }

        .file-info {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .file-preview {
            max-width: 60px;
        }

        .file-meta {
            flex-grow: 1;
        }
    </style>

    <input id="cvInput" type="file" title="ارفع سيرتك الذاتية" x-on:change="validateFile">
</label>
