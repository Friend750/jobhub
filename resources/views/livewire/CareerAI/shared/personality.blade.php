<div x-data="personalAnalysis">

    <!-- عرض النسب -->
    <div class="card shadow-sm p-4 d-flex flex-row justify-content-around rounded-4">
        <template x-for="(percent, index) in personalityPercentages" :key="index">
            <div class="text-end bg-primary rounded-4 p-3" @click="selectedIndex = index">
                <h6 class="progress-label" x-text="personalityLabels[index]"></h6>
                <div class="progress-circle d-flex align-items-center justify-content-between gap-2 mt-3">
                    <svg width="30" height="30" viewBox="0 0 70 70">
                        <circle cx="35" cy="35" r="30" class="bg"></circle>
                        <circle cx="35" cy="35" r="30" stroke-width="8"
                            :stroke="getColor(percent, index)"
                            stroke-dasharray="188.4"
                            :stroke-dashoffset="188.4 - (188.4 * percent / 100)">
                        </circle>
                    </svg>
                    <span class="progress-value" x-text="percent + '%'"></span>
                </div>
            </div>
        </template>
    </div>

    <!-- عرض البيانات المقابلة -->
    <div class="highlight card p-4 rounded-4" x-show="selectedIndex !== null">
        <h5 class="d-flex gap-2 mb-2">
            <i class="bi bi-stars"></i>
            <span x-text="personalityLabels[selectedIndex]"></span>
        </h5>
        <p class="py-3" x-text="personalityDescriptions[selectedIndex]"></p>
    </div>

    <!-- عرض التقييم والتحسينات -->
    <div class="highlight card p-4 rounded-4 mt-4">
        <h5>التقييم:</h5>
        <p x-text="evaluation"></p>
        <h5>التحسينات المقترحة:</h5>
        <ul>
            <template x-for="(improvement, index) in improvements" :key="index">
                <li x-text="improvement"></li>
            </template>
        </ul>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('personalAnalysis', () => {
            let personalData = sessionStorage.getItem('personalityDimensions') || '{"analysis": {}}';
            personalData = personalData.replace(/^\s*\\boxed\{\s*\{/, '{')
                                       .replace(/\}\s*\}\s*$/, '}');
            personalData = JSON.parse(personalData);

            let dimensions = personalData.analysis[0].dimensions || {};
            let score = personalData.analysis[0].score || {};

            return {
                selectedIndex: 0,

                personalityPercentages: [
                    score.openness * 10 || 0,
                    score.conscientiousness * 10 || 0,
                    score.diligence * 10 || 0,
                    score.agreeableness * 10 || 0,
                    score.neuroticism * 10 || 0
                ],
                getColor(percent, index) {
                    if (index === 40) { // العصابية
                        if (percent >= 80) return '#dc3545'; // أحمر
                        if (percent >= 60) return '#ffc107'; // أصفر
                        return '#28a745'; // أخضر
                    } else { // باقي الصفات
                        if (percent >= 80) return '#28a745'; // أخضر
                        if (percent >= 60) return '#ffc107'; // أصفر
                        return '#dc3545'; // أحمر
                    }
                },
                personalityLabels: [
                    'الانفتاح',
                    'الوعي',
                    'الاجتهاد',
                    'الوفاق',
                    'العصابية'
                ],
                personalityDescriptions: [
                    dimensions.openness || "لا يوجد تحليل متاح.",
                    dimensions.conscientiousness || "لا يوجد تحليل متاح.",
                    dimensions.diligence || "لا يوجد تحليل متاح.",
                    dimensions.agreeableness || "لا يوجد تحليل متاح.",
                    dimensions.neuroticism || "لا يوجد تحليل متاح."
                ],
                evaluation: personalData.analysis[0].evaluation || "لا يوجد تقييم متاح.",
                improvements: personalData.analysis[0].improvements || []
            };
        });
    });
</script>
