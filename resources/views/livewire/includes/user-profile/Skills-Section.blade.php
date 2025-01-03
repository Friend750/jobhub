<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5>Skills</h5>
            <div>
                <!-- Bootstrap 4 Modal Triggers -->
                <i class="bi bi-plus-circle btn p-1" data-toggle="modal" data-target="#NewSkills"></i>
                <i class="bi bi-pencil-square p-1 btn" data-toggle="modal" data-target="#EditSkills"></i>
            </div>
        </div>

        <ul class="list-unstyled d-flex flex-wrap" x-data="{ skills: @entangle('skills'), limit: 7 }">
            <template x-for="(skill, index) in skills" :key="index">
                <li class="btn btn-outline-secondary m-1" x-show="index < limit" x-text="skill"></li>
            </template>
            <li class="btn btn-secondary m-1" x-show="skills.length > limit" @click="limit = skills.length"
                x-text="'+' + (skills.length - limit) + ' more'">
            </li>
        </ul>

    </div>
</div>

<!-- modal NewSkills -->
<div class="modal fade overflow-hidden" id="NewSkills" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">NewSkills</h5>
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

<!-- modal EditSkills -->
<div class="modal fade overflow-hidden" id="EditSkills" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">EditSkills</h5>
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
