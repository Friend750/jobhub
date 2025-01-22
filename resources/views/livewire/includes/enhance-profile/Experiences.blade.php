<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#Experience">
        Experiences
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" x-on:click="toggleSection('experiences')" title="Remove section">
                <i class="fas fa-trash"></i>
            </button>

            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>Add details about your previous work experience. You can include multiple positions.</p>
    <div id="Experience" class="collapse">
        <div id="ExperienceContainer">
            <div class="experiences-block" id="initialExperiences">
                <div class="form-row mb-3">
                    <div class="form-group col-md-6">
                        <label for="jobTitle1" style="min-width: 150px;">Job Title 1</label>
                        <input type="text" class="form-control" placeholder="e.g., Software Engineer">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="employer1" style="min-width: 150px;">Company Name</label>
                        <input type="text" class="form-control" placeholder="e.g., ABC Corp">
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="form-group col-md-3">
                        <label for="experiencesStartDate" style="min-width: 150px;">Start Date </label>
                        <input type="text" class="form-control" placeholder="e.g., MM / YYYY">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="experiencesEndDate" style="min-width: 150px;">End Date </label>
                        <input type="text" class="form-control" placeholder="e.g., MM / YYYY">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city1" style="min-width: 150px;">City</label>
                        <input type="text" class="form-control" placeholder="e.g., New York">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description1" style="min-width: 150px;">Description 1</label>
                    <textarea class="form-control" rows="3" placeholder="what has been done at this position?"></textarea>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <button class="btn btn-primary rounded" onclick="addExperiences()">+ Add one more
                Experience</button>
        </div>
    </div>
</section>
