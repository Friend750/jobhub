<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#education">
        Education
        <i class="fas fa-caret-down"></i>
    </h5>
    <p>Add information about your educational background. You can include multiple entries.</p>
    <div id="education" class="collapse">
        <div id="educationContainer">
            <div class="row mb-3 education-block" id="initialEducation">
                <div class="form-group col-md-6">
                    <label for="degree1" style="min-width: 150px;">Degree</label>
                    <input type="text" class="form-control"
                        placeholder="Degree (e.g., Bachelor's, Master's)">
                </div>
                <div class="form-group col-md-6">
                    <label for="certification1" style="min-width: 150px;">Certification Name</label>
                    <input type="text" class="form-control"
                        placeholder="e.g., AWS Certified Solutions Architect">
                </div>
                <div class="form-group col-md-4">
                    <label for="institution1" style="min-width: 150px;">Institution Name</label>
                    <input type="text" class="form-control" placeholder="e.g., Harvard University">
                </div>
                <div class="form-group col-md-4">
                    <label for="location1" style="min-width: 150px;">Location</label>
                    <input type="text" class="form-control" placeholder="e.g., Cambridge, MA">
                </div>
                <div class="form-group col-md-4">
                    <label for="graduationDate1" style="min-width: 150px;">Month/Year of Graduation</label>
                    <input type="text" class="form-control" placeholder="e.g., 05 / 2022">
                </div>
                <div class="form-group col-12">
                    <label for="description1" style="min-width: 150px;">Description</label>
                    <textarea class="form-control" rows="3"
                        placeholder="Include any relevant coursework, honors, or GPA if applicable"></textarea>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <button class="btn btn-primary rounded" onclick="addEducation()">+ Add one more Education</button>
        </div>
    </div>
</section>
