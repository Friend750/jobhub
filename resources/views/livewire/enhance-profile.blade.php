<div>
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
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter Your First Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter Your Last Name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="jobTitle">Specialization name</label>
                        <input type="text" class="form-control" id="jobTitle" placeholder="Enter Your Job Title">
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
                <div class="text-end">
                    <button class="btn btn-primary rounded">Confirm</button>
                </div>
            </div>


        </div>

        <!-- Professional Summary -->
        <div class="form-section rounded">
            <h5>
                <span>Professional Summary</span>
                <i class="fas fa-caret-down caret-icon" data-toggle="collapse" data-target="#professionalSummary"></i>
            </h5>
            <p>Write 2-4 short, energetic sentences about how great you are. Mention the role and what you did. What
                were the big achievements? Describe your motivation and list your skills.</p>
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
            <p>You can add links to websites you want hiring managers to see! Perhaps it will be a link to your
                portfolio, or personal website.</p>
            <div id="websitesLinks" class="collapse">
                <div id="linksContainer">
                    <div class="row mb-3 link-block" id="initialLink">
                        <div class="form-group col-md-6">
                            <label for="website1" style="min-width: 150px;">Website Name 1</label>
                            <input type="text" class="form-control" placeholder="e.g., LinkedIn, GitHub, Portfolio">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="link1" style="min-width: 150px;">Link 1</label>
                            <input type="text" class="form-control"
                                placeholder="e.g., https://linkedin.com/in/yourprofile">
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
                            <label for="degree1" style="min-width: 150px;">Degree</label>
                            <input type="text" class="form-control"
                                placeholder="Degree (e.g., Bachelor's, Master's)">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="certification1" style="min-width: 150px;">Certification Name</label>
                            <input type="text" class="form-control"
                                placeholder="e.g., AWS Certified Solutions Architect">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="institution1" style="min-width: 150px;">Institution Name</label>
                            <input type="text" class="form-control" placeholder="e.g., Harvard University">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="location1" style="min-width: 150px;">Location</label>
                            <input type="text" class="form-control" placeholder="e.g., Cambridge, MA">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="graduationDate1" style="min-width: 150px;">Month/Year of Graduation</label>
                            <input type="text" class="form-control" placeholder="e.g., 05 / 2022">
                        </div>
                        <div class="form-group col-12">
                            <label for="description1" style="min-width: 150px;">Description</label>
                            <textarea class="form-control" rows="3"
                                placeholder="Include any relevant coursework, honors, or GPA if applicable"></textarea>
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

        <!-- Skills -->
        <div class="form-section rounded">
            <h5 data-toggle="collapse" data-target="#skills">
                Skills
                <i class="fas fa-caret-down"></i>
            </h5>
            <p>Choose 3 important skills that show you fit the position. Make sure they match the key skills mentioned
                in the job listing (especially when applying via an online system).</p>
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

        <!-- Experiences -->
        <section class="form-section rounded">
            <h5 data-toggle="collapse" data-target="#Experience">
                Experiences
                <i class="fas fa-caret-down"></i>
            </h5>
            <p>Add details about your previous work experience. You can include multiple positions.</p>
            <div id="Experience" class="collapse">
                <div id="ExperienceContainer">
                    <div class="experiences-block" id="initialExperiences">
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label for="jobTitle1" style="min-width: 150px;">Job Title 1</label>
                                <input type="text" class="form-control" placeholder="e.g., Software Engineer">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="employer1" style="min-width: 150px;">Company Name</label>
                                <input type="text" class="form-control" placeholder="e.g., ABC Corp">
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-3">
                                <label for="experiencesStartDate" style="min-width: 150px;">Start Date </label>
                                <input type="text" class="form-control" placeholder="e.g., MM / YYYY">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="experiencesEndDate" style="min-width: 150px;">End Date </label>
                                <input type="text" class="form-control" placeholder="e.g., MM / YYYY">
                            </div>
                                <div class="form-group col-md-6">
                                <label for="city1" style="min-width: 150px;">City</label>
                                <input type="text" class="form-control" placeholder="e.g., New York">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description1" style="min-width: 150px;">Description 1</label>
                            <textarea class="form-control" rows="3" placeholder="what has been done at this position?"></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button class="btn btn-primary rounded" onclick="addExperiences()">+ Add one more
                        Experience</button>
                </div>
            </div>
        </section>

        <!-- Projects -->
        <section class="form-section rounded">
            <h5 data-toggle="collapse" data-target="#projects">
                Projects
                <i class="fas fa-caret-down"></i>
            </h5>
            <p>List your projects, their descriptions, and key outcomes or contributions.</p>
            <div id="projects" class="collapse">
                <div id="projectsContainer">
                    <div class="project-block mb-3" id="initialProject">
                        <div class="form-group">
                            <label for="projectTitle1">Project Title 1</label>
                            <input type="text" class="form-control" id="projectTitle1"
                                placeholder="Enter Project Title">
                        </div>
                        <div class="form-group">
                            <label for="projectDescription1">Project describtion</label>
                            <textarea class="form-control" id="projectDescription1" rows="3" placeholder="Description of the project, including tools and technologies used"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="keyOutcomes1">Key Outcomes/Contributions</label>
                            <textarea class="form-control" id="keyOutcomes1" rows="2" placeholder="Key outcomes or contributions made during the project"></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button class="btn btn-primary rounded" onclick="addProject()">+ Add one more Project</button>
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
                            <label for="language1" style="min-width: fit-content;"><i class="fas fa-language"></i>
                                Language 1</label>
                            <input type="text" class="form-control ml-3 w-100" placeholder="English">
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
            <button class="btn-confirm btn btn-primary rounded">Confirm</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/enhanceProfile.js') }}"></script>


<!-- Websites & Social Links -->
{{-- <script>
    let linkCount = 1; // Initial count of links

    function addLink() {
        const links = document.querySelectorAll('.link-block');
        linkCount = links.length + 1;

        const newLink = document.createElement('div');
        newLink.classList.add('row', 'mb-3', 'link-block');
        newLink.innerHTML = `
                    <div class="form-group col-md-6">
                        <label for="website${linkCount}" style="min-width: 150px;">Website Name ${linkCount}</label>
                        <input type="text" class="form-control" placeholder="e.g., LinkedIn, GitHub, Portfolio">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="link${linkCount}" style="min-width: 150px;">Link ${linkCount}</label>
                        <input type="text" class="form-control" placeholder="e.g., https://linkedin.com/in/yourprofile">
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
</script> --}}

<!-- Education -->
{{-- <script>
    let educationCount = 1; // Initial count of education entries

    function addEducation() {
        const educations = document.querySelectorAll('.education-block');
        educationCount = educations.length + 1;

        const newEducation = document.createElement('div');
        newEducation.classList.add('row', 'mb-3', 'education-block');
        newEducation.innerHTML = `
                    <div class="form-group col-md-6">
                        <label for="degree${educationCount}" style="min-width: 150px;">Degree ${educationCount}</label>
                        <input type="text" class="form-control" placeholder="e.g., Bachelor's in Computer Science">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="certification${educationCount}" style="min-width: 150px;">Certification Name ${educationCount}</label>
                        <input type="text" class="form-control" placeholder="e.g., AWS Certified Solutions Architect">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="institution${educationCount}" style="min-width: 150px;">Institution Name ${educationCount}</label>
                        <input type="text" class="form-control" placeholder="e.g., Harvard University">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="location${educationCount}" style="min-width: 150px;">Location ${educationCount}</label>
                        <input type="text" class="form-control" placeholder="e.g., Cambridge, MA">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="graduationDate${educationCount}" style="min-width: 150px;">Month/Year of Graduation ${educationCount}</label>
                        <input type="text" class="form-control" placeholder="e.g., MM / YYYY">
                    </div>
                    <div class="form-group col-12">
                        <label for="description${educationCount}" style="min-width: 150px;">Description ${educationCount}</label>
                        <textarea class="form-control" rows="3" placeholder="Include any relevant coursework, honors, or GPA if applicable"></textarea>
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
            updateFieldLabels(education, newNumber, 'degree', 'Degree');
            updateFieldLabels(education, newNumber, 'certification', 'Certification Name');
            updateFieldLabels(education, newNumber, 'institution', 'Institution Name');
            updateFieldLabels(education, newNumber, 'location', 'Location');
            updateFieldLabels(education, newNumber, 'graduationDate', 'Month/Year of Graduation');
            updateFieldLabels(education, newNumber, 'description', 'Description');
        });
    }

    function updateFieldLabels(education, newNumber, fieldPrefix, labelText) {
        const label = education.querySelector(`label[for^="${fieldPrefix}"]`);
        const input = education.querySelector(`[id^="${fieldPrefix}"]`);
        if (label && input) {
            label.setAttribute('for', `${fieldPrefix}${newNumber}`);
            label.textContent = `${labelText} ${newNumber}`;
            input.setAttribute('id', `${fieldPrefix}${newNumber}`);
        }
    }
</script> --}}

<!-- Courses -->
{{-- <script>
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
                        <label for="courseName${courseCount}" style="min-width: 150px;" title="Enter the name of the course">Course Name ${courseCount}</label>
                        <input type="text" class="form-control" placeholder="e.g., Advanced JavaScript" title="Enter the course name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="institution${courseCount}" style="min-width: 150px;" title="Enter the institution offering the course">Institution ${courseCount}</label>
                        <input type="text" class="form-control" placeholder="e.g., Code Academy" title="Enter the institution name">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="courseStartDate${courseCount}" style="min-width: 150px;" title="Enter the start date in MM/YYYY format">Start Date ${courseCount}</label>
                        <input type="text" class="form-control" placeholder="MM / YYYY" title="Format: MM / YYYY">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="courseEndDate${courseCount}" style="min-width: 150px;" title="Enter the end date in MM/YYYY format">End Date ${courseCount}</label>
                        <input type="text" class="form-control" placeholder="MM / YYYY" title="Format: MM / YYYY">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city${courseCount}" style="min-width: 150px;" title="Enter the city where the course was taken">City ${courseCount}</label>
                        <input type="text" class="form-control" placeholder="e.g., New York" title="Enter the city">
                    </div>
                    <div class="text-right mt-3">
                        <i class="bi bi-trash-fill btn btn-outline-danger rounded" onclick="removeCourse(this)" title="Remove this course"></i>
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
</script> --}}

<!-- Skills -->
{{-- <script>
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
</script> --}}

<!-- Experiences -->
{{-- <script>
    let experiencesCount = 1; // Initial count of experiences entries

    function addExperiences() {
        const experiences = document.querySelectorAll('.experiences-block');
        experiencesCount = experiences.length + 1;

        const newExperiences = document.createElement('div');
        newExperiences.classList.add('experiences-block', 'mb-3');
        newExperiences.innerHTML = `
                    <div class="form-row mb-3">
                        <div class="form-group col-md-6">
                            <label for="jobTitle${experiencesCount}" style="min-width: 150px;">Job Title ${experiencesCount}</label>
                            <input type="text" class="form-control" placeholder="e.g., Software Engineer">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="employer${experiencesCount}" style="min-width: 150px;">Employer ${experiencesCount}</label>
                            <input type="text" class="form-control" placeholder="e.g., ABC Corp">
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="form-group col-md-3">
                            <label for="experiencesStartDate${experiencesCount}" style="min-width: 150px;">Start Date ${experiencesCount}</label>
                            <input type="text" class="form-control" placeholder="e.g., MM / YYYY">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="experiencesEndDate${experiencesCount}" style="min-width: 150px;">End Date ${experiencesCount}</label>
                            <input type="text" class="form-control" placeholder="e.g., MM / YYYY">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city${experiencesCount}" style="min-width: 150px;">City ${experiencesCount}</label>
                            <input type="text" class="form-control" placeholder="e.g., New York">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description${experiencesCount}" style="min-width: 150px;">Description ${experiencesCount}</label>
                        <textarea class="form-control" rows="3" placeholder="Describe your role and achievements"></textarea>
                    </div>
                    <div class="text-right mt-3">
                        <i class="bi bi-trash-fill btn btn-outline-danger rounded" onclick="removeExperiences(this)"></i>
                    </div>
                `;
        document.getElementById('ExperienceContainer').appendChild(newExperiences);
    }

    function removeExperiences(element) {
        const experiencesBlock = element.closest('.experiences-block');
        if (experiencesBlock && experiencesBlock.id !== 'initialExperiences') {
            experiencesBlock.remove();
        }

        const experiences = document.querySelectorAll('.experiences-block');
        experiences.forEach((experience, index) => {
            const newNumber = index + 1;
            const jobTitleLabel = experience.querySelector('label[for^="jobTitle"]');
            const jobTitleInput = experience.querySelector('input[id^="jobTitle"]');
            if (jobTitleLabel && jobTitleInput) {
                jobTitleLabel.setAttribute('for', `jobTitle${newNumber}`);
                jobTitleLabel.textContent = `Job Title ${newNumber}`;
                jobTitleInput.setAttribute('id', `jobTitle${newNumber}`);
            }

            const employerLabel = experience.querySelector('label[for^="employer"]');
            const employerInput = experience.querySelector('input[id^="employer"]');
            if (employerLabel && employerInput) {
                employerLabel.setAttribute('for', `employer${newNumber}`);
                employerLabel.textContent = `Employer ${newNumber}`;
                employerInput.setAttribute('id', `employer${newNumber}`);
            }

            const startDateLabel = experience.querySelector('label[for^="experiencesStartDate"]');
            const startDateInput = experience.querySelector('input[id^="experiencesStartDate"]');
            if (startDateLabel && startDateInput) {
                startDateLabel.setAttribute('for', `experiencesStartDate${newNumber}`);
                startDateInput.setAttribute('id', `experiencesStartDate${newNumber}`);
            }

            const endDateLabel = experience.querySelector('label[for^="experiencesEndDate"]');
            const endDateInput = experience.querySelector('input[id^="experiencesEndDate"]');
            if (endDateLabel && endDateInput) {
                endDateLabel.setAttribute('for', `experiencesEndDate${newNumber}`);
                endDateInput.setAttribute('id', `experiencesEndDate${newNumber}`);
            }

            const cityLabel = experience.querySelector('label[for^="city"]');
            const cityInput = experience.querySelector('input[id^="city"]');
            if (cityLabel && cityInput) {
                cityLabel.setAttribute('for', `city${newNumber}`);
                cityInput.setAttribute('id', `city${newNumber}`);
            }

            const descriptionLabel = experience.querySelector('label[for^="description"]');
            const descriptionTextarea = experience.querySelector('textarea[id^="description"]');
            if (descriptionLabel && descriptionTextarea) {
                descriptionLabel.setAttribute('for', `description${newNumber}`);
                descriptionLabel.textContent = `Description ${newNumber}`;
                descriptionTextarea.setAttribute('id', `description${newNumber}`);
            }
        });
    }
</script> --}}

<!-- Projects -->
{{-- <script>
    let projectCount = 1;

    function addProject() {
        projectCount++;
        const newProject = document.createElement('div');
        newProject.classList.add('project-block', 'mb-3');
        newProject.innerHTML = `
                    <div class="form-group">
                        <label for="projectTitle${projectCount}">Project Title ${projectCount}</label>
                        <input type="text" class="form-control" id="projectTitle${projectCount}" placeholder="Enter Project Title">
                    </div>
                    <div class="form-group">
                        <label for="projectDescription${projectCount}">Description of the Project</label>
                        <textarea class="form-control" id="projectDescription${projectCount}" rows="3" placeholder="Describe the project"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keyOutcomes${projectCount}">Key Outcomes or Contributions</label>
                        <textarea class="form-control" id="keyOutcomes${projectCount}" rows="2" placeholder="Mention key outcomes or contributions"></textarea>
                    </div>
                    <div class="text-right mt-3">
                        <i class="bi bi-trash-fill btn btn-outline-danger rounded" onclick="removeProject(this)"></i>
                    </div>
                `;
        document.getElementById('projectsContainer').appendChild(newProject);
    }

    function removeProject(element) {
        const projectBlock = element.closest('.project-block');
        if (projectBlock && projectBlock.id !== 'initialProject') {
            projectBlock.remove();
        }
    }
</script> --}}

<!-- Languages -->
{{-- <script>
    let languageCount = 1; // Initial count of languages

    function addLanguage() {
        const languages = document.querySelectorAll('.language-block');
        languageCount = languages.length + 1;

        const newLanguage = document.createElement('div');
        newLanguage.classList.add('form-row', 'mb-3', 'language-block');
        newLanguage.innerHTML = `
                            <div class="form-group d-flex align-items-center justify-content-around w-100">
                                <label for="language${languageCount}" style="min-width: fit-content;"><i class="fas fa-language"></i> Language ${languageCount}</label>
                                <input type="text" class="form-control ml-3 w-100" placeholder="English">
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
</script> --}}
