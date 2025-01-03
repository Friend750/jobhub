<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Experience</h5>
            <div>
                <!-- Bootstrap 4 Modal Triggers -->
                <i class="bi bi-plus-circle btn p-1" data-toggle="modal" data-target="#NewExperience"></i>
                <i class="bi bi-pencil-square p-1 btn" data-toggle="modal" data-target="#EditExperience"></i>
            </div>
        </div>
        <div class="mb-3">
            <ul class="list-unstyled">
                <div class="d-flex justify-content-between">
                    <li><strong> Job Title | Company Name | Location</strong></li>
                    <strong class="">[Month/Year – Month/Year]</strong>
                </div>
                <li class="text-muted">what has been done at this position</li>
            </ul>
        </div>
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
                <div class="container-fluid">Add rows here</div>
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
                <div class="container-fluid">Add rows here</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
