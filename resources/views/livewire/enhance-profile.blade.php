
<body>
    <div class="container mt-5">
        <!-- Personal Details -->
        <div class="form-section rounded">
            <h5>
                <span>Personal Details</span>
                <i class="fas fa-caret-down caret-icon" data-toggle="collapse" data-target="#personalDetails"></i>
            </h5>
            <div id="personalDetails" class="collapse show">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter Your Last Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jobTitle">Job Title</label>
                        <input type="text" class="form-control" id="jobTitle" placeholder="Enter Your Job Title">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter Your First Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter Your Email">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" placeholder="Enter Your Phone Number">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" placeholder="Enter Your City Name">
                    </div>
                </div>
                
            </div>
           
                <button class="btn btn-primary rounded ">Confirm</button>
          
        </div>
       

        <!-- Professional Summary -->
        <div class="form-section rounded">
            <h5>
                <span>Professional Summary</span>
                <i class="fas fa-caret-down caret-icon" data-toggle="collapse" data-target="#professionalSummary"></i>
            </h5>
            <p>Write 2-4 short, energetic sentences about how great you are. Mention the role and what you did. What were the big achievements? Describe your motivation and list your skills.</p>
            <div id="professionalSummary" class="collapse">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" rows="3" placeholder="Add a description here..."></textarea>
                </div>
            </div>
        </div>
        

        <!-- Websites & Social Links -->
        <section class="form-section rounded">
            <h5 data-toggle="collapse" data-target="#websitesLinks">
                Websites & Social Links
                <i class="fas fa-caret-down"></i>
            </h5>
            <p>You can add links to websites you want hiring managers to see! Perhaps it will be a link to your portfolio, or personal website.</p>
            <div id="websitesLinks" class="collapse">
                <div id="linksContainer">
                    <div class="form-row justify-content-center mb-3">
                        <div class="form-group col-md-6">
                            <label for="label">WebsiteName</label>
                            <input type="text" class="form-control" placeholder="Label">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" placeholder="Label">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary rounded " onclick="addLink()">+ Add one more Link</button>   
            </div>
        </section>
       
        
        <!-- Education -->
        <section class="form-section rounded">
            <h5 data-toggle="collapse" data-target="#education">
                Education
                <i class="fas fa-caret-down"></i>
            </h5>
            <p>Add information about your educational background. You can include multiple entries.</p>
            <div id="education" class="collapse ">
                <div id="educationContainer">
                    <div class="education-block">
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label for="jobTitle" style="min-width: 150px;">Job Title</label>
                                <input type="text" class="form-control" placeholder="Job title">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="employer" style="min-width: 150px;">Employer</label>
                                <input type="text" class="form-control" placeholder="Employer">
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-3">
                                <label for="startDate" style="min-width: 150px;">Start Date</label>
                                <input type="text" class="form-control" placeholder="MM / YYYY">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="endDate" style="min-width: 150px;">End Date</label>
                                <input type="text" class="form-control" placeholder="MM / YYYY">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city" style="min-width: 150px;">City</label>
                                <input type="text" class="form-control" placeholder="City">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" style="min-width: 150px;">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Describe"></textarea>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary rounded "onclick="addEducation()">+ Add one more Education</button>
            </div>
        </section>
      
        <!-- Courses -->
        <div class="form-section rounded">
            <h5 data-toggle="collapse" data-target="#courses">
                Courses
                <i class="fas fa-caret-down"></i>
            </h5>
            <p>List any certifications or additional training programs you have completed that are relevant to the position.</p>
            <div id="courses" class="collapse">
                <div id="coursesContainer">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="courseName" style="min-width: 150px;">Course Name</label>
                            <input type="text" class="form-control" placeholder="Course name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="institution" style="min-width: 150px;">Institution</label>
                            <input type="text" class="form-control" placeholder="Institution">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="courseStartDate" style="min-width: 150px;">Start Date</label>
                            <input type="text" class="form-control" id="courseStartDate" placeholder="MM / YYYY">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="courseEndDate" style="min-width: 150px;">End Date</label>
                            <input type="text" class="form-control" id="courseEndDate" placeholder="MM / YYYY">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city" style="min-width: 150px;">City</label>
                            <input type="text" class="form-control" placeholder="City">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary rounded "onclick="addCourse()">+ Add one more Course</button>
            </div>
        </div>
      
        

        <!-- Skills -->
        <div class="form-section rounded">
            <h5 data-toggle="collapse" data-target="#skills">
                Skills
                <i class="fas fa-caret-down"></i>
            </h5>
            <p>Choose 3 important skills that show you fit the position. Make sure they match the key skills mentioned in the job listing (especially when applying via an online system).</p>
            <div id="skills" class="collapse">
                <div id="skillsContainer">
                    <!-- Initial skill entries -->
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="skill1" style="min-width: 150px;">Skill 1</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" placeholder="Skill name">
                                <i class="bi bi-trash-fill btn btn-outline-danger rounded ml-1"></i>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="skill2" style="min-width: 150px;">Skill 2</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" placeholder="Skill name">
                                <i class="bi bi-trash-fill btn btn-outline-danger rounded ml-1"></i>
                            </div>
                          
                        </div>
                    </div>
                </div>
                <!-- Add more skill button -->
                <button class="btn btn-primary rounded " onclick="addSkill()">+ Add one more Skill</button>

            </div>
        </div>   
        
        
        <!-- Employment History -->
        <section class="form-section rounded">
            <h5 data-toggle="collapse" data-target="#employmentHistory">
                Employment History
                <i class="fas fa-caret-down"></i>
            </h5>
            <p>Add details about your previous work experience. You can include multiple positions.</p>
            <div id="employmentHistory" class="collapse">
                <div id="employmentHistoryContainer">
                    <div class="employment-block">
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label for="jobTitle" style="min-width: 150px;">Job Title</label>
                                <input type="text" class="form-control" placeholder="Job title">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="employer" style="min-width: 150px;">Employer</label>
                                <input type="text" class="form-control" placeholder="Employer">
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-3">
                                <label for="employmentStartDate" style="min-width: 150px;">Start Date</label>
                                <input type="text" class="form-control" placeholder="MM / YYYY">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="employmentEndDate" style="min-width: 150px;">End Date</label>
                                <input type="text" class="form-control" placeholder="MM / YYYY">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city" style="min-width: 150px;">City</label>
                                <input type="text" class="form-control" placeholder="City">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" style="min-width: 150px;">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Describe"></textarea>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary rounded "onclick="addEmployment()">+ Add one more Employment</button>

            </div>
        </section>
       
        
        
        <!-- Languages -->
        <section class="form-section rounded">
            <h5 data-toggle="collapse" data-target="#languages">
                Languages
                <i class="fas fa-caret-down"></i>
            </h5>
            <p>Enter the language(s) you speak  .</p>

            <div id="languages" class="collapse">
                <div id="languagesContainer">
                    <div class="form-row mb-3 w-100">
                        <div class="form-group d-flex align-items-center justify-content-around w-100">
                            <label for="language" style="min-width: fit-content;"><i class="fas fa-language"></i> Language</label>
                            <input type="text" class="form-control ml-3 w-100" placeholder="Language Name">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary rounded "onclick="addLanguage()">+ Add one more language</button>
            </div>
        </section>
        
        

        <!-- Confirm Button -->
        <div class="center-container">
            <button class="btn-confirm btn btn-primary">Confirm</button>
        </div>
    </div>
</body>

        

    
<script>
    function addLink() {
        // Create a new div for the additional fields
        const newLink = document.createElement('div');
        newLink.classList.add('form-row', 'justify-content-center', 'mb-3');

        // Add input fields for "Label"
        newLink.innerHTML = `
            <div class="form-group col-md-6">
                <label for="label">WebsiteName</label>
                <input type="text" class="form-control" placeholder="Label">
            </div>
            <div class="form-group col-md-6">
                <label for="link">Link</label>
                <input type="text" class="form-control" placeholder="Link">
            </div>
        `;

        // Append the new fields to the container
        document.getElementById('linksContainer').appendChild(newLink);
    }
</script>

<script>
    function addEducation() {
        // Create a container for the new education block
        const newEducation = document.createElement('div');
        newEducation.classList.add('education-block');

        // Add the new fields with a horizontal line
        newEducation.innerHTML = `
            <hr>
            <div class="form-row mb-3">
                <div class="form-group col-md-6">
                    <label for="jobTitle" style="min-width: 150px;">Job Title</label>
                    <input type="text" class="form-control" placeholder="Job title">
                </div>
                <div class="form-group col-md-6">
                    <label for="employer" style="min-width: 150px;">Employer</label>
                    <input type="text" class="form-control" placeholder="Employer">
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="form-group col-md-3">
                    <label for="startDate" style="min-width: 150px;">Start Date</label>
                    <input type="text" class="form-control" placeholder="MM / YYYY">
                </div>
                <div class="form-group col-md-3">
                    <label for="endDate" style="min-width: 150px;">End Date</label>
                    <input type="text" class="form-control" placeholder="MM / YYYY">
                </div>
                <div class="form-group col-md-6">
                    <label for="city" style="min-width: 150px;">City</label>
                    <input type="text" class="form-control" placeholder="City">
                </div>
            </div>
            <div class="form-group">
                <label for="description" style="min-width: 150px;">Description</label>
                <textarea class="form-control" rows="3" placeholder="Describe"></textarea>
            </div>
        `;

        // Append the new education block to the container
        document.getElementById('educationContainer').appendChild(newEducation);
    }
</script>

<script>
    function addCourse() {
        // Create a container for the new course
        const newCourse = document.createElement('div');
        newCourse.classList.add('course-block');
        // Add the fields for the new course
        newCourse.innerHTML = `
            <div class="form-row mb-3">
                <div class="form-group col-md-6">
                    <label for="courseName" style="min-width: 150px;">Course Name</label>
                    <input type="text" class="form-control" placeholder="Course name">
                </div>
                <div class="form-group col-md-6">
                    <label for="institution" style="min-width: 150px;">Institution</label>
                    <input type="text" class="form-control" placeholder="Institution">
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="form-group col-md-3">
                    <label for="courseStartDate" style="min-width: 150px;">Start Date</label>
                    <input type="text" class="form-control" id="courseStartDate" placeholder="MM / YYYY">
                </div>
                <div class="form-group col-md-3">
                    <label for="courseEndDate" style="min-width: 150px;">End Date</label>
                    <input type="text" class="form-control" id="courseEndDate" placeholder="MM / YYYY">
                </div>
                <div class="form-group col-md-6">
                    <label for="city" style="min-width: 150px;">City</label>
                    <input type="text" class="form-control" placeholder="City">
                </div>
            </div>
        `;

        // Add an <hr> to separate this block from others
        const line = document.createElement('hr');
        line.classList.add('separator');

        // Append the new fields and the line to the container
        const coursesContainer = document.getElementById('coursesContainer');
        coursesContainer.appendChild(line);
        coursesContainer.appendChild(newCourse);
    }
</script>

<script>
    let skillCount = 2; // Initial number of skills

    function addSkill() {
        skillCount++; // Increment the skill counter

        // Create a new div for the additional skill field
        const newSkill = document.createElement('div');
        newSkill.classList.add('mb-3');

        
        // Add the label and input field for the new skill
        newSkill.innerHTML = `
            <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="skill${skillCount}" style="min-width: 150px;">Skill ${skillCount}</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" placeholder="Skill name">
                                <i class="bi bi-trash-fill btn btn-outline-danger rounded ml-1"></i>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="skill${++skillCount}" style="min-width: 150px;">Skill ${skillCount}</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" placeholder="Skill name">
                                <i class="bi bi-trash-fill btn btn-outline-danger rounded ml-1"></i>
                            </div>
                        </div>
                    </div>
        `;

        // Append the new skill field to the skills container
        document.getElementById('skillsContainer').appendChild(newSkill);
    }
</script>

<script>
    function addEmployment() {
        // Create a container for the new employment block
        const newEmployment = document.createElement('div');
        newEmployment.classList.add('employment-block');
        
        // Add the new fields with a horizontal line
        newEmployment.innerHTML = `
            <hr>
            <div class="form-row mb-3">
                <div class="form-group col-md-6">
                    <label for="jobTitle" style="min-width: 150px;">Job Title</label>
                    <input type="text" class="form-control" placeholder="Job title">
                </div>
                <div class="form-group col-md-6">
                    <label for="employer" style="min-width: 150px;">Employer</label>
                    <input type="text" class="form-control" placeholder="Employer">
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="form-group col-md-3">
                    <label for="employmentStartDate" style="min-width: 150px;">Start Date</label>
                    <input type="text" class="form-control" placeholder="MM / YYYY">
                </div>
                <div class="form-group col-md-3">
                    <label for="employmentEndDate" style="min-width: 150px;">End Date</label>
                    <input type="text" class="form-control" placeholder="MM / YYYY">
                </div>
                <div class="form-group col-md-6">
                    <label for="city" style="min-width: 150px;">City</label>
                    <input type="text" class="form-control" placeholder="City">
                </div>
            </div>
            <div class="form-group">
                <label for="description" style="min-width: 150px;">Description</label>
                <textarea class="form-control" rows="3" placeholder="Describe"></textarea>
            </div>
        `;
        
        // Append the new employment block to the container
        document.getElementById('employmentHistoryContainer').appendChild(newEmployment);
    }
</script>

<script>
    function addLanguage() {
        // Create a new row for the additional language input field
        const newLanguage = document.createElement('div');
        newLanguage.classList.add('form-row');

        // Add the new language input field
        newLanguage.innerHTML = `
            <div class="form-row mb-3 w-100">
                        <div class="form-group d-flex align-items-center justify-content-around w-100">
                            <label for="language" style="min-width: fit-content;"><i class="fas fa-language ml-1"></i> Language</label>
                            <input type="text" class="form-control ml-3 w-100" placeholder="Language Name">
                        </div>
                    </div>
        `;
        
        // Append the new language field to the container
        document.getElementById('languagesContainer').appendChild(newLanguage);
    }
</script>