<!-- عرض النسب -->
<div x-data="technical">

    <div class="card shadow-sm p-4 d-flex flex-row justify-content-around rounded-4">
        <template x-for="(percent, index) in technicalPercentages" :key="index">
            <div class="text-end bg-primary rounded-4 p-3" @click="selectedIndex = index">
                <h6 class="progress-label" x-text="technicalLabels[index]"></h6>
                <div class="progress-circle d-flex align-items-center justify-content-between gap-2 mt-3">
                    <svg width="30" height="30" viewBox="0 0 70 70">
                        <circle cx="35" cy="35" r="30" class="bg"></circle>
                        <circle cx="35" cy="35" r="30" stroke-width="8" :stroke="getColor(percent)"
                            stroke-dasharray="188.4" :stroke-dashoffset="188.4 - (188.4 * percent / 10)">
                        </circle>
                    </svg>
                    <span class="progress-value" x-text="percent + '%'"></span>
                </div>
            </div>
        </template>
    </div>

    <!-- عرض البيانات المقابلة -->
    <div class="highlight card p-4 rounded-4" x-show="selectedIndex !== null">
        <h5 class="d-flex gap-2 mb-2"><i class="bi bi-stars"></i><span x-text="technicalLabels[selectedIndex]"></span>
        </h5>
        <p class="py-3" x-text="technicalDescriptions[selectedIndex]"></p>
    </div>

    <!-- عرض التقييم والتحسينات -->
    <div class="highlight card p-4 rounded-4 mt-4">
        <h5>التقييم:</h5>
        <p x-text="evaluation"></p>
        <h5>اقتراحات للتحسين:</h5>
        <ul>
            <template x-for="(improvement, index) in improvements" :key="index">
                <li x-text="improvement"></li>
            </template>
        </ul>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('technical', () => {
            // استرجاع بيانات تحليل الأبعاد التقنية من sessionStorage
            let techData = sessionStorage.getItem('techDimensions') || '{"analysis": {}}';
            techData = techData.replace(/^\\boxed\{|}$/g, ''); // إزالة أي تنسيق Boxed
            techData = JSON.parse(techData);
            let dimensions = techData.analysis?.dimensions || {};
            let score = techData.analysis?.score || {};

            return {
                selectedIndex: 0, // الفهرس المحدد

                // استخراج القيم بناءً على البيانات المسترجعة
                technicalPercentages: [
                    score.problem_solving || 0,
                    score.communication || 0,
                    score.teamwork || 0,
                    score.adaptability || 0
                ],
                technicalLabels: [
                    'حل المشكلات',
                    'التواصل',
                    'العمل الجماعي',
                    'التكيف'
                ],
                technicalColors: ["blue", "purple", "green", "orange"],
                technicalDescriptions: [
                    dimensions.problem_solving || "لا يوجد تحليل متاح.",
                    dimensions.communication || "لا يوجد تحليل متاح.",
                    dimensions.teamwork || "لا يوجد تحليل متاح.",
                    dimensions.adaptability || "لا يوجد تحليل متاح."
                ],
                getColor(percent) {
                    if (percent >= 8) return '#28a745';
                    if (percent >= 6) return '#ffc107';
                    return '#dc3545';
                },
                // التقييم والاقتراحات
                evaluation: techData.analysis?.evaluation || "لا يوجد تقييم متاح.",
                improvements: techData.analysis?.improvements || []
            };
        });
    });
</script>