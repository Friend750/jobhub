
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Projects</h5>
            <div>
                <!-- Bootstrap 4 Modal Triggers -->
                <i class="bi bi-plus-circle btn p-1" data-toggle="modal" data-target="#NewProjects"></i>
                <i class="bi bi-pencil-square p-1 btn" data-toggle="modal" data-target="#EditProjects"></i>
            </div>
        </div>

        <div class="mb-3">
            <ul class="list-unstyled">
                <div class="d-flex justify-content-between">
                    <li><strong>Project Title</strong></li>
                </div>
                <ul>

                    <li>[Description of the project, including tools and technologies used]</li>
                    <li>[Key outcomes or contributions made during the project]</li>

                </ul>
            </ul>
        </div>
    </div>
</div>

<!-- modal NewProjects -->
<div class="modal fade overflow-hidden" id="NewProjects" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">NewProjects</h5>
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

<!-- modal EditProjects -->
<div class="modal fade overflow-hidden" id="EditProjects" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">EditProjects</h5>
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
