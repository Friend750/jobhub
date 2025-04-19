<!-- Job Title -->
<div class="header">

    <h3 class="mb-2 fw-bolder text-primary d-inline" x-text="jobTitle"></h3>
    <small class="badge bg-light text-muted border" x-text="jobTiming"></small>


    <!-- Location, Timing, and Post Date -->
    <div class="d-flex flex-wrap align-items-center text-muted fw-semibold mb-3 gap-2">
        <small x-text="jobLocation"></small>
        <small class="small">•</small><br>
        <small x-text="createdAt"></small>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex gap-2 mb-4">
        <button class="btn btn-primary btn-sm px-3 py-2 rounded fw-bold">
            تقديم طلب
            <i class="fa-solid fa-up-right-from-square"></i>
        </button>
    </div>
</div>

<!-- About Section -->
<div class="mb-4">
    <h6 class="fw-bold text-dark mb-2">عن الوظيفة</h6>
    <div class="mb-3">
        <p class="mb-0">
            <small class="fw-semibold">الشركة او المؤسس:</small>
            <small x-text="getCompanyName()"></small>
        </p>
        <p class="mb-0">
            <small class="fw-semibold">الموقع:</small>
            <small x-text="jobLocation"></small>
        </p>
        <p class="mb-0">
            <small class="fw-semibold">فترة العمل:</small>
            <small x-text="jobTiming"></small>
        </p>
    </div>

    <template x-if="aboutJob">
        <div class="mb-3">
            <p class="fw-semibold m-0 text-dark">نظرة عامة على الوظيفة:</p>
            <small x-text="aboutJob"></sma>
        </div>
    </template>
</div>

<!-- Key Responsibilities -->
<template x-if="jobTasks && jobTasks.trim()">
    <div class="mb-4">
        <h6 class="fw-bold mb-2 text-dark">المسؤوليات الرئيسية:</h6>
        <small x-html="formatBulletPoints(jobTasks)"></small>
    </div>
</template>

<!-- Job Conditions -->
<template x-if="jobConditions && jobConditions.trim()">
    <div class="mb-4">
        <h6 class="fw-bold mb-2 text-dark">شروط الوظيفة:</h6>
        <small x-html="formatBulletPoints(jobConditions)"></small>
    </div>
</template>

<!-- Required Skills -->
<template x-if="jobSkills">
    <div class="mb-0">
        <h6 class="fw-bold mb-2 text-dark">المهارات المطلوبة:</h6>
        <div class="d-flex flex-wrap gap-2">
            <template x-for="skill in jobSkills.split(',')">
                <span class="badge bg-primary bg-opacity-10 text-primary" x-text="skill.trim()"></span>
            </template>
        </div>
    </div>
</template>

{{-- job tags array --}}
<template x-if="jobTags !== null && jobTags.length > 0">
    <div class="mb-0">
        <h6 class="fw-bold mb-2 text-dark">الوسوم:</h6>
        <div class="d-flex flex-wrap gap-2">
            <template x-for="tag in jobTags">
                <span class="badge bg-primary bg-opacity-10 text-primary" x-text="tag"></span>
            </template>
        </div>
    </div>
</template>
