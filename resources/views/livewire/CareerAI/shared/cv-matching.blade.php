<div x-data="cvAnalysis">
    <!-- عرض النسب -->
    <div class="card shadow-sm p-4 d-flex flex-row justify-content-around rounded-4">
        <template x-for="(percent, index) in percentages" :key="index">
            <div class="text-end bg-primary rounded-4 p-3" @click="selectedIndex = index">
                <h6 class="progress-label" x-text="labels[index]"></h6>
                <div class="progress-circle d-flex align-items-center justify-content-between gap-2 mt-3">
                    <svg width="30" height="30" viewBox="0 0 70 70">
                        <circle cx="35" cy="35" r="30" class="bg"></circle>
                        <circle cx="35" cy="35" r="30" stroke-width="8" :stroke="getColor(percent)"
                            stroke-dasharray="188.4" :stroke-dashoffset="188.4 - (188.4 * percent / 100)">
                        </circle>
                    </svg>
                    <span class="progress-value" x-text="percent + '%'"></span>
                </div>
            </div>
        </template>
    </div>

    <!-- عرض البيانات المقابلة -->
    <div class="highlight card p-4 rounded-4 mt-4" x-show="selectedIndex !== null">
        <h5 class="d-flex gap-2 mb-2">
            <i class="bi bi-stars"></i>
            <span x-text="labels[selectedIndex]"></span>
        </h5>
        <p class="py-3">
            رأي الذكاء الاصطناعي الخاص بـ <span x-text="labels[selectedIndex]"></span>:
            <span x-text="descriptions[selectedIndex]"></span>
        </p>
    </div>

    <!-- Overall CV Rating -->
    <div class="highlight card shadow-sm p-4 rounded-4 mt-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-stars"></i> تقييم السيرة الذاتية العام: <span
                :class="getOverallScoreColor(overallScore)" x-text="overallScore + '/10'"></span></h5>
        <p x-text="ATSdescriptions"></p>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('cvAnalysis', () => {
            const jobData = JSON.parse(localStorage.getItem('jobData')) || {};
            let cvData = jobData.cv || {};
            cvData = cvData.replace(/^\s*\\boxed\{\s*\{/, '{').replace(/\}\s*\}\s*$/, '}'); // إزالة }}

            // استبدال الفواصل الزائدة (إن وجدت)
            cvData = cvData.replace(/,(\s*[\]\}])/g, '$1');

            cvData = JSON.parse(cvData);

            // Define section order and Arabic labels
            const sectionsOrder = [
                'Work Experience',
                'Education',
                'Skills',
                'Projects',
                'Certifications',
                'Professional Summary',

            ];

            const sectionLabels = {
                'Work Experience': 'الخبرة',
                'Education': 'التعليم',
                'Skills': 'المهارات',
                'Projects': 'المشاريع',
                'Certifications': 'الشهادات',
                'Professional Summary': 'الملخص المهني',
            };

            // Generate dynamic data arrays
            const percentages = sectionsOrder.map(section => cvData[section]?.score || 0);
            const labels = sectionsOrder.map(section => sectionLabels[section]);
            const descriptions = sectionsOrder.map(section => cvData[section]?.recom || '');
            const ATSdescriptions = cvData.ATS?.recom || '';



            return {
                selectedIndex: 0,
                percentages,
                labels,
                descriptions,
                ATSdescriptions: ATSdescriptions,

                get overallScore() {
                    const total = this.percentages.reduce((sum, percent) => sum + percent, 0);
                    const average = total / this.percentages.length;
                    return (average / 10).toFixed(1);
                },


                getColor(percent) {
                    if (percent >= 80) return '#28a745';
                    if (percent >= 60) return '#ffc107';
                    return '#dc3545';
                },

                getOverallScoreColor(score) {

                    console.log(cvData);
                    if (score >= 8) return 'text-success';
                    if (score >= 6) return 'text-warning';
                    return 'text-danger';
                },

            };
        });
    });
</script>