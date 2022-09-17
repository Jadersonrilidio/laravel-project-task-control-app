@component('mail::message')

# {{ $task->task }}

Deadline: {{ $task->deadline }}

@component('mail::button', ['url' => $url])
Click here to visualize task
@endcomponent

Best regards,<br>
{{ config('app.name') }}
@endcomponent
