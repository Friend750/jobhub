<form wire:submit.prevent ="saveExperience">
    <div class="modal fade overflow-hidden" id="EditExperience" tabindex="-1" aria-labelledby="modalTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="modalTitleId">التعديل على خبرة</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <div>
                        @foreach ($ExperienceForm->experiences as $index => $experience)
                            <div class="experiences-block mb-4">
                                @if ($index > 0)
                                    <hr>
                                @endif
                                <div class="row mb-3">
                                    <div class="form-group col-md-6">
                                        <label class="mb-2" for="job_title_{{ $index }}">اسم الوظيفة</label>
                                        <input type="text"
                                            class="form-control @error("ExperienceForm.experiences.{$index}.job_title") is-invalid @enderror"
                                            wire:model="ExperienceForm.experiences.{{ $index }}.job_title"
                                            placeholder="e.g., Software Engineer">
                                        @error("ExperienceForm.experiences.{$index}.job_title")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="mb-2" for="company_name_{{ $index }}">اسم مكان العمل</label>
                                        <input type="text"
                                            class="form-control @error("ExperienceForm.experiences.{$index}.company_name") is-invalid @enderror"
                                            wire:model="ExperienceForm.experiences.{{ $index }}.company_name"
                                            placeholder="e.g., ABC Corp">
                                        @error("ExperienceForm.experiences.{$index}.company_name")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="form-group col-md-6">
                                        <label class="mb-2" for="start_date_{{ $index }}">تاريخ البداية</label>
                                        <input type="date"
                                            class="form-control @error("ExperienceForm.experiences.{$index}.start_date") is-invalid @enderror"
                                            wire:model="ExperienceForm.experiences.{{ $index }}.start_date">
                                        @error("ExperienceForm.experiences.{$index}.start_date")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="mb-2" for="end_date_{{ $index }}">تاريخ الانتهاء</label>
                                        <input type="date"
                                            class="form-control @error("ExperienceForm.experiences.{$index}.end_date") is-invalid @enderror"
                                            wire:model="ExperienceForm.experiences.{{ $index }}.end_date">
                                        @error("ExperienceForm.experiences.{$index}.end_date")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="mb-2" for="location_{{ $index }}">الموقع</label>
                                        <input type="text"
                                            class="form-control @error("ExperienceForm.experiences.{$index}.location") is-invalid @enderror"
                                            wire:model="ExperienceForm.experiences.{{ $index }}.location"
                                            placeholder="e.g., New York">
                                        @error("ExperienceForm.experiences.{$index}.location")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2" for="description_{{ $index }}">الوصف</label>
                                    <textarea class="form-control @error("ExperienceForm.experiences.{$index}.description") is-invalid @enderror"
                                        wire:model="ExperienceForm.experiences.{{ $index }}.description" rows="3"
                                        placeholder="What has been done at this position?"></textarea>
                                    @error("ExperienceForm.experiences.{$index}.description")
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn rounded btn-dark" style="min-width: 40px;"
                        x-on:click="removeExperience()" wire:loading.attr='disabled'><i
                            class="fas fa-trash"></i></button>
                    <button type="submit" class="btn rounded btn-primary" wire:loading.attr='disabled'>حفظ التغييرات</button>
                </div>
            </div>
        </div>
    </div>
</form>
