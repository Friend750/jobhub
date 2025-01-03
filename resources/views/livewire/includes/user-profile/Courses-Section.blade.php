<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Certifications | Courses</h5>
            <div>
                <!-- Bootstrap 4 Modal Triggers -->
                <i class="bi bi-plus-circle btn p-1" data-toggle="modal" data-target="#NewCourses"></i>
                <i class="bi bi-pencil-square p-1 btn" data-toggle="modal" data-target="#EditCourses"></i>
            </div>
        </div>

        <div class="mb-3">
            <ul class="list-unstyled">
                <div class="d-flex justify-content-between">
                    <li><strong>Certification Name | Institution/Provider | Location</strong></li>
                    <strong class="">Completion Date</strong>
                </div>
            </ul>
        </div>
    </div>
</div>

<!-- modal NewCourses -->
<div class="modal fade overflow-hidden" id="NewCourses" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">NewCourses</h5>
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

<!-- modal EditCourses -->
<div class="modal fade overflow-hidden" id="EditCourses" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">EditCourses</h5>
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
