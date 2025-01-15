<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Certifications | Courses</h5>
            <div>
                <!-- Bootstrap 4 Modal Triggers -->
                <i class="bi bi-plus-circle btn p-1" data-toggle="modal" data-target="#NewCourses"></i>
                {{-- <i class="bi bi-pencil-square p-1 btn" data-toggle="modal" data-target="#EditCourses"></i> --}}
            </div>
        </div>


        <ul class="list-unstyled">
            <div class="d-flex justify-content-between">
                <li><strong>Certification Name | Institution/Provider</strong></li>
                <div class="d-flex justify-content-between align-items-center">
                    <strong class="">[Complition date]</strong>
                    <i class="bi bi-pencil-square  py-0 px-1 ms-3 btn" data-toggle="modal"
                        data-target="#EditCourses"></i>
                </div>
            </div>
        </ul>
        <ul class="list-unstyled">
            <div class="d-flex justify-content-between">
                <li><strong>Certification Name | Institution/Provider</strong></li>
                <div class="d-flex justify-content-between align-items-center">
                    <strong class="">[Complition date]</strong>
                    <i class="bi bi-pencil-square  py-0 px-1 ms-3 btn" data-toggle="modal"
                        data-target="#EditCourses"></i>
                </div>
            </div>
        </ul>

    </div>
</div>

<!-- modal NewCourses -->
<div class="modal fade overflow-hidden" id="NewCourses" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">New Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="coursesContainer">
                    <div class="form-row course-block" id="initialCourse">
                        <div class="form-group col-md-4">
                            <label for="courseName1" style="min-width: 150px;">Course name</label>
                            <input type="text" class="form-control" placeholder="e.g., Data Science Bootcamp">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="institution1" style="min-width: 150px;">Institution name</label>
                            <input type="text" class="form-control" placeholder="e.g., Coursera, Udemy">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="courseStartDate1" style="min-width: 150px;">Completion date</label>
                            <input type="text" class="form-control" id="courseStartDate1" placeholder="MM / YYYY"
                                title="Enter the start date in MM / YYYY format">
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

<!-- modal EditCourses -->
<div class="modal fade overflow-hidden" id="EditCourses" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Edit a Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="coursesContainer">
                    <div class="form-row course-block" id="initialCourse">
                        <div class="form-group col-md-4">
                            <label for="courseName1" style="min-width: 150px;">Course name</label>
                            <input type="text" class="form-control" placeholder="e.g., Data Science Bootcamp">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="institution1" style="min-width: 150px;">Institution name</label>
                            <input type="text" class="form-control" placeholder="e.g., Coursera, Udemy">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="courseStartDate1" style="min-width: 150px;">Completion date</label>
                            <input type="text" class="form-control" id="courseStartDate1" placeholder="MM / YYYY"
                                title="Enter the start date in MM / YYYY format">
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
