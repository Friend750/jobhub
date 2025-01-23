<div class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#courses">
        Courses
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" x-on:click="toggleSection('courses')" title="Remove section">
                <i class="fas fa-trash"></i>
            </button>

            <i class="fas fa-caret-down caret-icon"></i>
        </div>
    </h5>
    <p>List any certifications or additional training programs you have completed that are relevant to the
        position.</p>
    <div id="courses" class="collapse">
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
        <div class="d-flex justify-content-between align-items-center mt-3">
            <button class="btn btn-primary rounded" onclick="addCourse()">+ Add one more Course</button>
        </div>
    </div>
</div>

