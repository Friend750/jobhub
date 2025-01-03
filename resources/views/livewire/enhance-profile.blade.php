
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
                    <div class="row mb-3 link-block" id="initialLink">
                        <div class="form-group col-md-6">
                            <label for="website1" style="min-width: 150px;">Website Name 1</label>
                            <input type="text" class="form-control" placeholder="Website Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="link1" style="min-width: 150px;">Link 1</label>
                            <input type="text" class="form-control" placeholder="Website Link">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button class="btn btn-primary rounded" onclick="addLink()">+ Add one more Link</button>
                </div>
            </div>
        </section>
        
        <!-- Education -->
        <section class="form-section rounded">
            <h5 data-toggle="collapse" data-target="#education">
                Education
                <i class="fas fa-caret-down"></i>
            </h5>
            <p>Add information about your educational background. You can include multiple entries.</p>
            <div id="education" class="collapse">
                <div id="educationContainer">
                    <div class="row mb-3 education-block" id="initialEducation">
                        <div class="form-group col-md-6">
                            <label for="jobTitle1" style="min-width: 150px;">Job Title 1</label>
                            <input type="text" class="form-control" placeholder="Job Title">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="employer1" style="min-width: 150px;">Employer 1</label>
                            <input type="text" class="form-control" placeholder="Employer">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="startDate1" style="min-width: 150px;">Start Date 1</label>
                            <input type="text" class="form-control" placeholder="MM / YYYY">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="endDate1" style="min-width: 150px;">End Date 1</label>
                            <input type="text" class="form-control" placeholder="MM / YYYY">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city1" style="min-width: 150px;">City 1</label>
                            <input type="text" class="form-control" placeholder="City">
                        </div>
                        <div class="form-group col-12">
                            <label for="description1" style="min-width: 150px;">Description 1</label>
                            <textarea class="form-control" rows="3" placeholder="Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button class="btn btn-primary rounded" onclick="addEducation()">+ Add one more Education</button>
                </div>
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
                    <div class="form-row course-block" id="initialCourse">
                        <div class="form-group col-md-6">
                            <label for="courseName1" style="min-width: 150px;">Course Name 1</label>
                            <input type="text" class="form-control" placeholder="Course name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="institution1" style="min-width: 150px;">Institution 1</label>
                            <input type="text" class="form-control" placeholder="Institution">
                        </div>
                    </div>
                    <div class="form-row course-block">
                        <div class="form-group col-md-3">
                            <label for="courseStartDate1" style="min-width: 150px;">Start Date 1</label>
                            <input type="text" class="form-control" id="courseStartDate1" placeholder="MM / YYYY">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="courseEndDate1" style="min-width: 150px;">End Date 1</label>
                            <input type="text" class="form-control" id="courseEndDate1" placeholder="MM / YYYY">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city1" style="min-width: 150px;">City 1</label>
                            <input type="text" class="form-control" placeholder="City">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button class="btn btn-primary rounded" onclick="addCourse()">+ Add one more Course</button>
                </div>
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
                    <div class="row mb-3 skill-block" id="initialSkill">
                        <div class="form-group col-md-6">
                            <label for="skill1" style="min-width: 150px;">Skill 1</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" placeholder="Skill name">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="skill2" style="min-width: 150px;">Skill 2</label>
                            <div class="d-flex">
                                <input type="text" class="form-control" placeholder="Skill name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button class="btn btn-primary rounded" onclick="addSkill()">+ Add one more Skill</button>
                </div>
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
                    <div class="employment-block" id="initialEmployment">
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label for="jobTitle1" style="min-width: 150px;">Job Title 1</label>
                                <input type="text" class="form-control" placeholder="Job title">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="employer1" style="min-width: 150px;">Employer 1</label>
                                <input type="text" class="form-control" placeholder="Employer">
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-3">
                                <label for="employmentStartDate1" style="min-width: 150px;">Start Date 1</label>
                                <input type="text" class="form-control" placeholder="MM / YYYY">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="employmentEndDate1" style="min-width: 150px;">End Date 1</label>
                                <input type="text" class="form-control" placeholder="MM / YYYY">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city1" style="min-width: 150px;">City 1</label>
                                <input type="text" class="form-control" placeholder="City">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description1" style="min-width: 150px;">Description 1</label>
                            <textarea class="form-control" rows="3" placeholder="Describe"></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button class="btn btn-primary rounded" onclick="addEmployment()">+ Add one more Employment</button>
                </div>
            </div>
        </section>
        

        <!-- Languages -->
        <section class="form-section rounded">
            <h5 data-toggle="collapse" data-target="#languages">
                Languages
                <i class="fas fa-caret-down"></i>
            </h5>
            <p>Enter the language(s) you speak.</p>
            <div id="languages" class="collapse">
                <div id="languagesContainer">
                    <div class="form-row mb-3 language-block" id="initialLanguage">
                        <div class="form-group d-flex align-items-center justify-content-around w-100">
                            <label for="language1" style="min-width: fit-content;"><i class="fas fa-language"></i> Language 1</label>
                            <input type="text" class="form-control ml-3 w-100" placeholder="Language Name">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button class="btn btn-primary rounded" onclick="addLanguage()">+ Add one more language</button>
                </div>
            </div>
        </section>
        
        
        <!-- Confirm Button -->
        <div class="center-container">
            <button class="btn-confirm btn btn-primary">Confirm</button>
        </div>
    </div>
</body>


        <!-- Websites & Social Links -->
        <script>
            let linkCount = 1; // Initial count of links
        
            function addLink() {
                const links = document.querySelectorAll('.link-block');
                linkCount = links.length + 1;
        
                const newLink = document.createElement('div');
                newLink.classList.add('row', 'mb-3', 'link-block');
                newLink.innerHTML = `
                    <div class="form-group col-md-6">
                        <label for="website${linkCount}" style="min-width: 150px;">Website Name ${linkCount}</label>
                        <input type="text" class="form-control" placeholder="Website Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="link${linkCount}" style="min-width: 150px;">Link ${linkCount}</label>
                        <input type="text" class="form-control" placeholder="Website Link">
                    </div>
                    <div class="text-right mt-3">
                        <i class="bi bi-trash-fill btn btn-outline-danger rounded" onclick="removeLink(this)"></i>
                    </div>
                `;
                document.getElementById('linksContainer').appendChild(newLink);
            }
        
            function removeLink(element) {
                const linkBlock = element.closest('.link-block');
                if (linkBlock && linkBlock.id !== 'initialLink') {
                    linkBlock.remove();
                }
        
                const links = document.querySelectorAll('.link-block');
                links.forEach((link, index) => {
                    const newNumber = index + 1;
                    const nameLabel = link.querySelector('label[for^="website"]');
                    const nameInput = link.querySelector('input[id^="website"]');
                    if (nameLabel && nameInput) {
                        nameLabel.setAttribute('for', `website${newNumber}`);
                        nameLabel.textContent = `Website Name ${newNumber}`;
                        nameInput.setAttribute('id', `website${newNumber}`);
                    }
        
                    const linkLabel = link.querySelector('label[for^="link"]');
                    const linkInput = link.querySelector('input[id^="link"]');
                    if (linkLabel && linkInput) {
                        linkLabel.setAttribute('for', `link${newNumber}`);
                        linkLabel.textContent = `Link ${newNumber}`;
                        linkInput.setAttribute('id', `link${newNumber}`);
                    }
                });
            }
        </script>
        

        <!-- Education -->
        <script>
            let educationCount = 1; // Initial count of education entries
        
            function addEducation() {
                const educations = document.querySelectorAll('.education-block');
                educationCount = educations.length + 1;
        
                const newEducation = document.createElement('div');
                newEducation.classList.add('row', 'mb-3', 'education-block');
                newEducation.innerHTML = `
                    <div class="form-group col-md-6">
                        <label for="jobTitle${educationCount}" style="min-width: 150px;">Job Title ${educationCount}</label>
                        <input type="text" class="form-control" placeholder="Job Title">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="employer${educationCount}" style="min-width: 150px;">Employer ${educationCount}</label>
                        <input type="text" class="form-control" placeholder="Employer">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="startDate${educationCount}" style="min-width: 150px;">Start Date ${educationCount}</label>
                        <input type="text" class="form-control" placeholder="MM / YYYY">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="endDate${educationCount}" style="min-width: 150px;">End Date ${educationCount}</label>
                        <input type="text" class="form-control" placeholder="MM / YYYY">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city${educationCount}" style="min-width: 150px;">City ${educationCount}</label>
                        <input type="text" class="form-control" placeholder="City">
                    </div>
                    <div class="form-group col-12">
                        <label for="description${educationCount}" style="min-width: 150px;">Description ${educationCount}</label>
                        <textarea class="form-control" rows="3" placeholder="Description"></textarea>
                    </div>
                    <div class="text-right mt-3">
                        <i class="bi bi-trash-fill btn btn-outline-danger rounded" onclick="removeEducation(this)"></i>
                    </div>
                `;
                document.getElementById('educationContainer').appendChild(newEducation);
            }
        
            function removeEducation(element) {
                const educationBlock = element.closest('.education-block');
                if (educationBlock && educationBlock.id !== 'initialEducation') {
                    educationBlock.remove();
                }
        
                const educations = document.querySelectorAll('.education-block');
                educations.forEach((education, index) => {
                    const newNumber = index + 1;
                    const titleLabel = education.querySelector('label[for^="jobTitle"]');
                    const titleInput = education.querySelector('input[id^="jobTitle"]');
                    if (titleLabel && titleInput) {
                        titleLabel.setAttribute('for', `jobTitle${newNumber}`);
                        titleLabel.textContent = `Job Title ${newNumber}`;
                        titleInput.setAttribute('id', `jobTitle${newNumber}`);
                    }
        
                    const employerLabel = education.querySelector('label[for^="employer"]');
                    const employerInput = education.querySelector('input[id^="employer"]');
                    if (employerLabel && employerInput) {
                        employerLabel.setAttribute('for', `employer${newNumber}`);
                        employerLabel.textContent = `Employer ${newNumber}`;
                        employerInput.setAttribute('id', `employer${newNumber}`);
                    }
        
                    const startDateLabel = education.querySelector('label[for^="startDate"]');
                    const startDateInput = education.querySelector('input[id^="startDate"]');
                    if (startDateLabel && startDateInput) {
                        startDateLabel.setAttribute('for', `startDate${newNumber}`);
                        startDateInput.setAttribute('id', `startDate${newNumber}`);
                    }
        
                    const endDateLabel = education.querySelector('label[for^="endDate"]');
                    const endDateInput = education.querySelector('input[id^="endDate"]');
                    if (endDateLabel && endDateInput) {
                        endDateLabel.setAttribute('for', `endDate${newNumber}`);
                        endDateInput.setAttribute('id', `endDate${newNumber}`);
                    }
        
                    const cityLabel = education.querySelector('label[for^="city"]');
                    const cityInput = education.querySelector('input[id^="city"]');
                    if (cityLabel && cityInput) {
                        cityLabel.setAttribute('for', `city${newNumber}`);
                        cityInput.setAttribute('id', `city${newNumber}`);
                    }
        
                    const descriptionLabel = education.querySelector('label[for^="description"]');
                    const descriptionTextarea = education.querySelector('textarea[id^="description"]');
                    if (descriptionLabel && descriptionTextarea) {
                        descriptionLabel.setAttribute('for', `description${newNumber}`);
                        descriptionLabel.textContent = `Description ${newNumber}`;
                        descriptionTextarea.setAttribute('id', `description${newNumber}`);
                    }
                });
            }
        </script>

        <!-- Courses -->
        <script>
            let courseCount = 1; // Initial count of courses
        
            function addCourse() {
                // Increment courseCount based on existing number of courses
                const courses = document.querySelectorAll('.course-block');
                const courseNumbers = Array.from(courses).map(course => {
                    const label = course.querySelector('label[for^="courseName"]');
                    if (label) {
                        return parseInt(label.getAttribute('for').replace('courseName', ''), 10);
                    }
                    return 0;
                });
                courseCount = Math.max(0, ...courseNumbers) + 1;
        
                const newCourse = document.createElement('div');
                newCourse.classList.add('form-row', 'mb-3', 'course-block');
                newCourse.innerHTML = `
                    <div class="form-group col-md-6">
                        <label for="courseName${courseCount}" style="min-width: 150px;">Course Name ${courseCount}</label>
                        <input type="text" class="form-control" placeholder="Course name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="institution${courseCount}" style="min-width: 150px;">Institution ${courseCount}</label>
                        <input type="text" class="form-control" placeholder="Institution">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="courseStartDate${courseCount}" style="min-width: 150px;">Start Date ${courseCount}</label>
                        <input type="text" class="form-control" placeholder="MM / YYYY">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="courseEndDate${courseCount}" style="min-width: 150px;">End Date ${courseCount}</label>
                        <input type="text" class="form-control" placeholder="MM / YYYY">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city${courseCount}" style="min-width: 150px;">City ${courseCount}</label>
                        <input type="text" class="form-control" placeholder="City">
                    </div>
                    <div class="text-right mt-3">
                        <i class="bi bi-trash-fill btn btn-outline-danger rounded" onclick="removeCourse(this)"></i>
                    </div>
                `;
                document.getElementById('coursesContainer').appendChild(newCourse);
            }
        
            function removeCourse(element) {
                const courseBlock = element.closest('.course-block');
                if (courseBlock && courseBlock.id !== 'initialCourse') {
                    courseBlock.remove();
                }
        
                // Renumber remaining courses
                const courses = document.querySelectorAll('.course-block');
                courses.forEach((course, index) => {
                    const newNumber = index + 1;
                    const nameLabel = course.querySelector('label[for^="courseName"]');
                    const nameInput = course.querySelector('input[id^="courseName"]');
                    if (nameLabel && nameInput) {
                        nameLabel.setAttribute('for', `courseName${newNumber}`);
                        nameLabel.textContent = `Course Name ${newNumber}`;
                        nameInput.setAttribute('id', `courseName${newNumber}`);
                    }
        
                    const institutionLabel = course.querySelector('label[for^="institution"]');
                    const institutionInput = course.querySelector('input[id^="institution"]');
                    if (institutionLabel && institutionInput) {
                        institutionLabel.setAttribute('for', `institution${newNumber}`);
                        institutionLabel.textContent = `Institution ${newNumber}`;
                        institutionInput.setAttribute('id', `institution${newNumber}`);
                    }
        
                    const startDateLabel = course.querySelector('label[for^="courseStartDate"]');
                    const startDateInput = course.querySelector('input[id^="courseStartDate"]');
                    if (startDateLabel && startDateInput) {
                        startDateLabel.setAttribute('for', `courseStartDate${newNumber}`);
                        startDateInput.setAttribute('id', `courseStartDate${newNumber}`);
                    }
        
                    const endDateLabel = course.querySelector('label[for^="courseEndDate"]');
                    const endDateInput = course.querySelector('input[id^="courseEndDate"]');
                    if (endDateLabel && endDateInput) {
                        endDateLabel.setAttribute('for', `courseEndDate${newNumber}`);
                        endDateInput.setAttribute('id', `courseEndDate${newNumber}`);
                    }
        
                    const cityLabel = course.querySelector('label[for^="city"]');
                    const cityInput = course.querySelector('input[id^="city"]');
                    if (cityLabel && cityInput) {
                        cityLabel.setAttribute('for', `city${newNumber}`);
                        cityInput.setAttribute('id', `city${newNumber}`);
                    }
                });
            }
        </script>

        <!-- Skills -->
        <script>
            let skillCount = 2; // Initial count of skills
        
            function addSkill() {
                const skills = document.querySelectorAll('.skill-block');
                skillCount = skills.length + 2;
        
                const newSkill = document.createElement('div');
                newSkill.classList.add('row', 'mb-3', 'skill-block');
                newSkill.innerHTML = `
                    <div class="form-group col-md-6">
                        <label for="skill${skillCount}" style="min-width: 150px;">Skill ${skillCount}</label>
                        <div class="d-flex">
                            <input type="text" class="form-control" placeholder="Skill name">
                            <i class="bi bi-trash-fill btn btn-outline-danger rounded ml-1" onclick="removeSkill(this)"></i>
                        </div>
                    </div>
                `;
                document.getElementById('skillsContainer').appendChild(newSkill);
            }
            function removeSkill(element) {
                const skillBlock = element.closest('.skill-block');
                if (skillBlock && skillBlock.id !== 'initialSkill') {
                    skillBlock.remove();
                }
                const skills = document.querySelectorAll('.skill-block');
                skills.forEach((skill, index) => {
                    const newNumber = index + 1;
                    const skillLabel = skill.querySelector('label[for^="skill"]');
                    const skillInput = skill.querySelector('input[id^="skill"]');
                    if (skillLabel && skillInput) {
                        skillLabel.setAttribute('for', `skill${newNumber}`);
                        skillLabel.textContent = `Skill ${newNumber}`;
                        skillInput.setAttribute('id', `skill${newNumber}`);
                    }
                });
            }
        </script>
        
        <!-- Employment History -->
        <script>
            let employmentCount = 1; // Initial count of employment entries
        
            function addEmployment() {
                const employments = document.querySelectorAll('.employment-block');
                employmentCount = employments.length + 1;
        
                const newEmployment = document.createElement('div');
                newEmployment.classList.add('employment-block', 'mb-3');
                newEmployment.innerHTML = `
                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <label for="jobTitle${employmentCount}" style="min-width: 150px;">Job Title ${employmentCount}</label>
                            <input type="text" class="form-control" placeholder="Job title">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="employer${employmentCount}" style="min-width: 150px;">Employer ${employmentCount}</label>
                            <input type="text" class="form-control" placeholder="Employer">
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="form-group col-md-3">
                            <label for="employmentStartDate${employmentCount}" style="min-width: 150px;">Start Date ${employmentCount}</label>
                            <input type="text" class="form-control" placeholder="MM / YYYY">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="employmentEndDate${employmentCount}" style="min-width: 150px;">End Date ${employmentCount}</label>
                            <input type="text" class="form-control" placeholder="MM / YYYY">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city${employmentCount}" style="min-width: 150px;">City ${employmentCount}</label>
                            <input type="text" class="form-control" placeholder="City">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description${employmentCount}" style="min-width: 150px;">Description ${employmentCount}</label>
                        <textarea class="form-control" rows="3" placeholder="Describe"></textarea>
                    </div>
                    <div class="text-right mt-3">
                        <i class="bi bi-trash-fill btn btn-outline-danger rounded" onclick="removeEmployment(this)"></i>
                    </div>
                `;
                document.getElementById('employmentHistoryContainer').appendChild(newEmployment);
            }
        
            function removeEmployment(element) {
                const employmentBlock = element.closest('.employment-block');
                if (employmentBlock && employmentBlock.id !== 'initialEmployment') {
                    employmentBlock.remove();
                }
        
                const employments = document.querySelectorAll('.employment-block');
                employments.forEach((employment, index) => {
                    const newNumber = index + 1;
                    const jobTitleLabel = employment.querySelector('label[for^="jobTitle"]');
                    const jobTitleInput = employment.querySelector('input[id^="jobTitle"]');
                    if (jobTitleLabel && jobTitleInput) {
                        jobTitleLabel.setAttribute('for', `jobTitle${newNumber}`);
                        jobTitleLabel.textContent = `Job Title ${newNumber}`;
                        jobTitleInput.setAttribute('id', `jobTitle${newNumber}`);
                    }
        
                    const employerLabel = employment.querySelector('label[for^="employer"]');
                    const employerInput = employment.querySelector('input[id^="employer"]');
                    if (employerLabel && employerInput) {
                        employerLabel.setAttribute('for', `employer${newNumber}`);
                        employerLabel.textContent = `Employer ${newNumber}`;
                        employerInput.setAttribute('id', `employer${newNumber}`);
                    }
        
                    const startDateLabel = employment.querySelector('label[for^="employmentStartDate"]');
                    const startDateInput = employment.querySelector('input[id^="employmentStartDate"]');
                    if (startDateLabel && startDateInput) {
                        startDateLabel.setAttribute('for', `employmentStartDate${newNumber}`);
                        startDateInput.setAttribute('id', `employmentStartDate${newNumber}`);
                    }
        
                    const endDateLabel = employment.querySelector('label[for^="employmentEndDate"]');
                    const endDateInput = employment.querySelector('input[id^="employmentEndDate"]');
                    if (endDateLabel && endDateInput) {
                        endDateLabel.setAttribute('for', `employmentEndDate${newNumber}`);
                        endDateInput.setAttribute('id', `employmentEndDate${newNumber}`);
                    }
        
                    const cityLabel = employment.querySelector('label[for^="city"]');
                    const cityInput = employment.querySelector('input[id^="city"]');
                    if (cityLabel && cityInput) {
                        cityLabel.setAttribute('for', `city${newNumber}`);
                        cityInput.setAttribute('id', `city${newNumber}`);
                    }
        
                    const descriptionLabel = employment.querySelector('label[for^="description"]');
                    const descriptionTextarea = employment.querySelector('textarea[id^="description"]');
                    if (descriptionLabel && descriptionTextarea) {
                        descriptionLabel.setAttribute('for', `description${newNumber}`);
                        descriptionLabel.textContent = `Description ${newNumber}`;
                        descriptionTextarea.setAttribute('id', `description${newNumber}`);
                    }
                });
            }
        </script>
        

        <!-- Languages -->
        <script>
            let languageCount = 1; // Initial count of languages
        
            function addLanguage() {
                const languages = document.querySelectorAll('.language-block');
                languageCount = languages.length + 1;
        
                const newLanguage = document.createElement('div');
                newLanguage.classList.add('form-row', 'mb-3', 'language-block');
                newLanguage.innerHTML = `
                    <div class="form-group d-flex align-items-center justify-content-around w-100">
                        <label for="language${languageCount}" style="min-width: fit-content;"><i class="fas fa-language"></i> Language ${languageCount}</label>
                        <input type="text" class="form-control ml-3 w-100" placeholder="Language Name">
                        <i class="bi bi-trash-fill btn btn-outline-danger rounded ml-1" onclick="removeLanguage(this)"></i>
                    </div>
                `;
                document.getElementById('languagesContainer').appendChild(newLanguage);
            }
        
            function removeLanguage(element) {
                const languageBlock = element.closest('.language-block');
                if (languageBlock && languageBlock.id !== 'initialLanguage') {
                    languageBlock.remove();
                }
        
                const languages = document.querySelectorAll('.language-block');
                languages.forEach((language, index) => {
                    const newNumber = index + 1;
                    const languageLabel = language.querySelector('label[for^="language"]');
                    const languageInput = language.querySelector('input[id^="language"]');
                    if (languageLabel && languageInput) {
                        languageLabel.setAttribute('for', `language${newNumber}`);
                        languageLabel.textContent = `Language ${newNumber}`;
                        languageInput.setAttribute('id', `language${newNumber}`);
                    }
                });
            }
        </script>
        








