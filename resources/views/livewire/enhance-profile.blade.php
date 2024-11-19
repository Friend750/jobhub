<div class="container mt-5">
    <!-- Personal Details -->
    <div class="form-section">
        <h5>
            <span>Personal Details</span>
            <i class="fas fa-caret-down caret-icon" data-toggle="collapse" data-target="#personalDetails"></i>
        </h5>
        <div id="personalDetails" class="collapse show">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="jobTitle">Job Title</label>
                    <input type="text" class="form-control" id="jobTitle" placeholder="Job Title">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="First Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" placeholder="Country">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Phone">
                </div>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" placeholder="City">
            </div>
        </div>
    </div>

    <!-- Professional Summary -->
    <div class="form-section">
        <h5>
            <span>Professional Summary</span>
            <i class="fas fa-caret-down caret-icon" data-toggle="collapse" data-target="#professionalSummary"></i>
        </h5>
        <div id="professionalSummary" class="collapse show">
            <p>Write 2-4 short, energetic sentences about how great you are. Mention the role and what you did. What were the big achievements? Describe your motivation and list your skills.</p>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3" placeholder="Add a description here..."></textarea>
            </div>
        </div>
    </div>

    <!-- Websites & Social Links -->
    <div class="form-section">
        <h5 data-toggle="collapse" data-target="#websitesLinks">
            Websites & Social Links
            <i class="fas fa-caret-down"></i>
        </h5>
        <div id="websitesLinks" class="collapse show">
            <p>You can add links to websites you want hiring managers to see! Perhaps it will be a link to your portfolio, or personal website.</p>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-5">
                    <label for="label">Label</label>
                    <input type="text" class="form-control" placeholder="Label">
                </div>
                <div class="form-group col-md-5">
                    <label for="link">Link</label>
                    <input type="text" class="form-control" placeholder="Link">
                </div>
            </div>
            <span class="btn-add">+ Add one more Link</span>
        </div>
    </div>

    <!-- Education -->
    <div class="form-section">
        <h5 data-toggle="collapse" data-target="#education">
            Education
            <i class="fas fa-caret-down"></i>
        </h5>
        <div id="education" class="collapse show">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="jobTitle">Job Title</label>
                    <input type="text" class="form-control" placeholder="Job title">
                </div>
                <div class="form-group col-md-6">
                    <label for="employer">Employer</label>
                    <input type="text" class="form-control" placeholder="Employer">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group  col-6">
                    <label for="startDate">Start Date</label>
                    <input type="date" class="form-control " id="startDate" placeholder="MM / YYYY">
                </div>
                <div class="form-group col-6">
                    <label for="endDate">End Date</label>
                    <input type="date" class="form-control " id="endDate" placeholder="MM / YYYY">
                </div>
                <br>
                <div class="form-group pl-2 pb-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" placeholder="City">
                </div>

            </div>
            <div class="form-group pl-2">
                <label for="describe">Describe</label>
                <textarea class="form-control" rows="3" placeholder="Describe"></textarea>
            </div>
            <span class="btn-add">+ Add one more Education</span>
        </div>
    </div>

    <!-- Courses -->
    <div class="form-section">
        <h5 data-toggle="collapse" data-target="#courses">
            Courses
            <i class="fas fa-caret-down"></i>
        </h5>
        <div id="courses" class="collapse show">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="courseName">Course Name</label>
                    <input type="text" class="form-control" placeholder="Course name">
                </div>
                <div class="form-group col-md-6">
                    <label for="institution">Institution</label>
                    <input type="text" class="form-control" placeholder="Institution">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="courseStartDate">Start Date</label>
                    <input type="date" class="form-control" id="courseStartDate" placeholder="MM / YYYY">
                </div>
                <div class="form-group col-6">
                    <label for="courseEndDate">End Date</label>
                    <input type="date" class="form-control" id="courseEndDate" placeholder="MM / YYYY">
                </div>
                <div class="form-group pl-2 ">
                    <label for="city">City</label>
                    <input type="text" class="form-control" placeholder="City">
                </div>
            </div>
            <span class="btn-add">+ Add one more Course</span>
        </div>
    </div>

    <!-- Skills -->
    <div class="form-section">
        <h5 data-toggle="collapse" data-target="#skills">
            Skills
            <i class="fas fa-caret-down"></i>
        </h5>
        <div id="skills" class="collapse show">
            <p>Choose 3 important skills that show you fit the position. Make sure they match the key skills mentioned in the job listing (especially when applying via an online system).</p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="skills">Skill 1</label>
                    <input type="text" class="form-control" placeholder="Skill name">
                </div>
                <div class="form-group col-md-6">
                    <label for="skills">Skill 2</label>
                    <input type="text" class="form-control" placeholder="Skill name">
                </div>
            </div>
            <span class="btn-add">+ Add one more Skill</span>
        </div>
    </div>

    <!-- Employment History -->
    <div class="form-section">
        <h5 data-toggle="collapse" data-target="#employmentHistory">
            Employment History
            <i class="fas fa-caret-down"></i>
        </h5>
        <div id="employmentHistory" class="collapse show">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="jobTitle">Job Title</label>
                    <input type="text" class="form-control" placeholder="Job title">
                </div>
                <div class="form-group col-md-6">
                    <label for="employer">Employer</label>
                    <input type="text" class="form-control" placeholder="Employer">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="employmentStartDate">Start Date</label>
                    <input type="date" class="form-control" id="employmentStartDate" placeholder="MM / YYYY">
                </div>
                <div class="form-group col-6">
                    <label for="employmentEndDate">End Date</label>
                    <input type="date" class="form-control" id="employmentEndDate" placeholder="MM / YYYY">
                </div>
                <div class="form-group pb-3 pl-2">
                    <label for="city">City</label>
                    <input type="text" class="form-control" placeholder="City">
                </div>
            </div>
            <div class="form-group pl-2">
                <label for="description">Description</label>
                <textarea class="form-control" rows="3" placeholder="Describe"></textarea>
            </div>
            <span class="btn-add">+ Add one more Employment</span>
        </div>
    </div>

    <!-- Languages -->
    <div class="form-section">
        <h5 data-toggle="collapse" data-target="#languages">
            Languages
            <i class="fas fa-caret-down"></i>
        </h5>
        <div id="languages" class="collapse show">
            <div class="form-group">
                <label for="language"><i class="fas fa-language"></i> Language</label>
                <input type="text" class="form-control" placeholder="Language">
            </div>
            <span class="btn-add">+ Add one more language</span>
        </div>
    </div>

    <!-- Confirm Button -->
    <div class="center-container">
        <button class="btn-confirm btn btn-primary">Confirm</button>
    </div>
    
