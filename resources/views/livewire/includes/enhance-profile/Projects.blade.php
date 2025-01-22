<section class="form-section rounded">
    <h5 data-toggle="collapse" data-target="#projects">
        Projects
        <div class="d-flex align-items-center">
            <button class="btn text-muted btn-sm me-3 trash-button" type="button" x-on:click="toggleSection('projects')" title="Remove section">
                <i class="fas fa-trash"></i>
            </button>

            <i class="fas fa-caret-down caret-icon"></i>
        </div>
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
        <div class="d-flex justify-content-between align-items-center mt-3">
            <button class="btn btn-primary rounded" onclick="addProject()">+ Add one more Project</button>
        </div>
    </div>
</section>
