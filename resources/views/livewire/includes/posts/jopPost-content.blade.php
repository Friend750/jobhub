<h4 class="text-primary">{{ $post->job_title }}</h4>
<p class="mb-2"><strong>حول الوظيفة:</strong> {{ $post->about_job }}</p>
<p class="mb-2"><strong>المهام:</strong> {{ $post->job_tasks }}</p>
@if($post->job_conditions)
    <p class="mb-2"><strong>الشروط:</strong> {{ $post->job_conditions }}</p>
@endif
