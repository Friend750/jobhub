<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Education</h5>
            <div>
                <!-- Bootstrap 4 Modal Triggers -->
                <i class="bi bi-plus-circle btn p-1" data-toggle="modal" data-target="#NewEducation"></i>
                <i class="bi bi-pencil-square p-1 btn" data-toggle="modal" data-target="#EditEducation"></i>
            </div>
        </div>

        <div class="mb-3">
            <ul class="list-unstyled">
                <div class="d-flex justify-content-between">
                    <li><strong>[Degree/Certification Name]</strong></li>
                    <strong class="">[Month/Year of Graduation]</strong>
                </div>
                <li>[Institution Name] | [Location]</li>
                <li>[Include any relevant coursework, honors, or GPA if applicable]</li>
            </ul>
        </div>
    </div>
</div>

<!-- modal NewEducation -->
<div class="modal fade overflow-hidden" id="NewEducation" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">NewEducation</h5>
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

<!-- modal EditEducation -->
<div class="modal fade overflow-hidden" id="EditEducation" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">EditEducation</h5>
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
