<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Experience</h5>
            <div>
                <!-- Bootstrap 4 Modal Triggers -->
                <i class="bi bi-plus-circle btn p-1" data-toggle="modal" data-target="#NewExperience"></i>
            </div>
        </div>

        <ul class="list-unstyled">
            <div class="d-flex justify-content-between align-items-center">
                <strong> Job Title | Company Name | Location</strong>
                <div class="d-flex justify-content-between align-items-center">
                    <strong class="">[Month/Year – Month/Year]</strong>
                    <i class="bi bi-pencil-square  py-0 px-1 ms-3 btn" data-toggle="modal"
                        data-target="#EditExperience"></i>
                </div>
            </div>
            <li class="text-muted">what has been done at this position</li>
        </ul>


        <ul class="list-unstyled">
            <div class="d-flex justify-content-between align-items-center">
                <strong> Job Title | Company Name | Location</strong>
                <div class="d-flex justify-content-between align-items-center">
                    <strong class="">[Month/Year – Month/Year]</strong>
                    <i class="bi bi-pencil-square  py-0 px-1 ms-3 btn" data-toggle="modal"
                        data-target="#EditExperience"></i>
                </div>
            </div>
            <li class="text-muted">what has been done at this position</li>
        </ul>

    </div>
</div>

<!-- modal NewExperience -->
<div class="modal fade overflow-hidden" id="NewExperience" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">New Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="ExperienceContainer">
                    <div class="experiences-block" id="initialExperiences">
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label for="jobTitle1" style="min-width: 150px;">Job Title </label>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- modal EditExperience -->
<div class="modal fade overflow-hidden" id="EditExperience" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Edit Experience</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="ExperienceContainer">
                    <div class="experiences-block" id="initialExperiences">
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label for="jobTitle1" style="min-width: 150px;">Job Title </label>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
