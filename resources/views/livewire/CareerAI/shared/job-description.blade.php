<div class="card border-0 shadow-sm">
    <div class="p-3 pb-1">
        <h5 class="mb-0">وصف الوظيفة (افتراضي وقابل للتعديل)</h5>
    </div>
    <div class="card-body">
        <textarea class="form-control h-100" rows="8" placeholder="سيتم ملئه تلقائيا بعد عملية اختيار المسمى الوظيفي.."
            x-model="jobDescription" x-init="autoResize($el)" x-on:input="autoResize($el)" style="resize: none; min-height: 50vh;"></textarea>
        <span x-text="errors.desc" class="text-danger mt-2"></span>
    </div>
</div>
