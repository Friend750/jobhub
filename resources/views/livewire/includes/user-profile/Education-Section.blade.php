<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Education</h5>
            <div>
                <!-- Bootstrap 4 Modal Triggers -->
                <i class="bi bi-plus-circle btn p-1" data-toggle="modal" data-target="#NewEducation"></i>
                {{-- <i class="bi bi-pencil-square p-1 btn" data-toggle="modal" data-target="#EditEducation"></i> --}}
            </div>
        </div>


        <ul class="list-unstyled">
            <div class="d-flex justify-content-between">
                <li><strong>[Degree/Certification Name]</strong></li>
                <div class="d-flex justify-content-between align-items-center">
                    <strong class="">[Month/Year]</strong>
                    <i class="bi bi-pencil-square  py-0 px-1 ms-3 btn" data-toggle="modal"
                        data-target="#EditEducation"></i>
                </div>
            </div>
            <li>[Institution Name] | [Location]</li>
            <li>[Include any relevant coursework, honors, or GPA if applicable]</li>
        </ul>
        <ul class="list-unstyled">
            <div class="d-flex justify-content-between">
                <li><strong>[Degree/Certification Name]</strong></li>
                <div class="d-flex justify-content-between align-items-center">
                    <strong class="">[Month/Year]</strong>
                    <i class="bi bi-pencil-square  py-0 px-1 ms-3 btn" data-toggle="modal"
                        data-target="#EditEducation"></i>
                </div>
            </div>
            <li>[Institution Name] | [Location]</li>
            <li>[Include any relevant coursework, honors, or GPA if applicable]</li>
        </ul>

    </div>
</div>

<!-- modal NewEducation -->
<div class="modal fade overflow-hidden" id="NewEducation" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">New Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                            <label for="graduationDate1" style="min-width: 150px;">Date</label>
                            <input type="text" class="form-control" placeholder="e.g., 05 / 2022">
                        </div>
                        <div class="form-group col-12">
                            <label for="description1" style="min-width: 150px;">Description</label>
                            <textarea class="form-control" rows="3"
                                placeholder="Include any relevant coursework, honors, or GPA if applicable"></textarea>
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

<!-- modal EditEducation -->
<div class="modal fade overflow-hidden" id="EditEducation" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Edit a Education</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                            <label for="graduationDate1" style="min-width: 150px;">Date</label>
                            <input type="text" class="form-control" placeholder="e.g., 05 / 2022">
                        </div>
                        <div class="form-group col-12">
                            <label for="description1" style="min-width: 150px;">Description</label>
                            <textarea class="form-control" rows="3"
                                placeholder="Include any relevant coursework, honors, or GPA if applicable"></textarea>
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
