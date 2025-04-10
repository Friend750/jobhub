<div class="card shadow-sm mb-3 rounded-4">
    <ul class="d-flex justify-content-around p-4 list-unstyled mb-0">
        <li class="nav-item">
            <span class="nav-link" :class="{ 'active fw-bolder': activeTab === 'personality' }"
                @click="activeTab = 'personality'">تحليل الشخصية</span>
        </li>
        <span class="text-muted">|</span>
        <li class="nav-item">
            <span class="nav-link" :class="{ 'active fw-bolder': activeTab === 'technical' }"
                @click="activeTab = 'technical'">تحليل المهارات التقنية</span>
        </li>
        <span class="text-muted">|</span>
        <li class="nav-item">
            <span class="nav-link" :class="{ 'active fw-bolder': activeTab === 'interview' }"
                @click="activeTab = 'interview'">أسئلة المقابلة</span>
        </li>
        <span class="text-muted">|</span>
        <li class="nav-item">
            <span class="nav-link" :class="{ 'active fw-bolder': activeTab === 'resume' }"
                @click="activeTab = 'resume'">تحليل توافق السيرة الذاتية</span>
        </li>
    </ul>
</div>
