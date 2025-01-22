<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#languages">
        Languages
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" x-on:click="toggleSection('languages')" title="Remove section">
                <i class="fas fa-trash"></i>
            </button>

            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>Enter the language(s) you speak.</p>
    <div id="languages" class="collapse">
        <div id="languagesContainer">
            <div class="form-row mb-3 language-block" id="initialLanguage">
                <div class="form-group d-flex align-items-center justify-content-around w-100">
                    <label for="language1" style="min-width: fit-content;"><i class="fas fa-language"></i>
                        Language 1</label>
                    <input type="text" class="form-control ml-3 w-100" placeholder="English">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <button class="btn btn-primary rounded" onclick="addLanguage()">+ Add one more language</button>
        </div>
    </div>
</section>
