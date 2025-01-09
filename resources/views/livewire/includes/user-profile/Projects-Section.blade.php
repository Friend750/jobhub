<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Projects</h5>
            <div>
                <!-- Bootstrap 4 Modal Triggers -->
                <i class="bi bi-plus-circle btn p-1" data-toggle="modal" data-target="#NewProjects"></i>
                {{-- <i class="bi bi-pencil-square p-1 btn" data-toggle="modal" data-target="#EditProjects"></i> --}}
            </div>
        </div>


        <ul class="list-unstyled">
            <div class="d-flex justify-content-between align-items-center">
                <div class="left">
                    <div class="d-flex justify-content-between">
                        <li><strong>Project Title</strong></li>
                    </div>
                    <ul>

                        <li>[Description of the project, including tools and technologies used]</li>
                        <li>[Key outcomes or contributions made during the project]</li>

                    </ul>

                </div>

                <div class="right-icon">
                    <i class="bi bi-pencil-square  py-0 px-1 ms-3 btn" data-toggle="modal"
                        data-target="#EditProjects"></i>

                </div>
            </div>
        </ul>
        <ul class="list-unstyled">
            <div class="d-flex justify-content-between align-items-center">
                <div class="left">
                    <div class="d-flex justify-content-between">
                        <li><strong>Project Title</strong></li>
                    </div>
                    <ul>

                        <li>[Description of the project, including tools and technologies used]</li>
                        <li>[Key outcomes or contributions made during the project]</li>

                    </ul>

                </div>

                <div class="right-icon">
                    <i class="bi bi-pencil-square  py-0 px-1 ms-3 btn" data-toggle="modal"
                        data-target="#EditProjects"></i>

                </div>
            </div>
        </ul>

    </div>
</div>

<!-- modal NewProjects -->
<div class="modal fade overflow-hidden" id="NewProjects" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">New Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="projectsContainer">
                    <div class="project-block mb-3" id="initialProject">
                        <div class="form-group">
                            <label for="projectTitle1">Project Title</label>
                            <input type="text" class="form-control" id="projectTitle1"
                                placeholder="Enter Project Title">
                        </div>
                        <div class="form-group">
                            <label for="projectDescription1">Project describtion</label>
                            <textarea class="form-control" id="projectDescription1" rows="3"
                                placeholder="Description of the project, including tools and technologies used"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="keyOutcomes1">Key Outcomes/Contributions</label>
                            <textarea class="form-control" id="keyOutcomes1" rows="2"
                                placeholder="Key outcomes or contributions made during the project"></textarea>
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

<!-- modal EditProjects -->
<div class="modal fade overflow-hidden" id="EditProjects" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Edit a Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="projectsContainer">
                    <div class="project-block mb-3" id="initialProject">
                        <div class="form-group">
                            <label for="projectTitle1">Project Title</label>
                            <input type="text" class="form-control" id="projectTitle1"
                                placeholder="Enter Project Title">
                        </div>
                        <div class="form-group">
                            <label for="projectDescription1">Project describtion</label>
                            <textarea class="form-control" id="projectDescription1" rows="3"
                                placeholder="Description of the project, including tools and technologies used"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="keyOutcomes1">Key Outcomes/Contributions</label>
                            <textarea class="form-control" id="keyOutcomes1" rows="2"
                                placeholder="Key outcomes or contributions made during the project"></textarea>
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
