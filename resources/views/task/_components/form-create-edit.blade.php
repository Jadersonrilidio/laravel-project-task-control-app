<form action="{{ isset($task->id) ? route('task.update', ['task' => $task->id]) : route('task.store') }}" method="POST">

    @csrf
    @if(isset($task->id))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="task" class="form-label">Task</label>
        <input type="text" name="task" class="form-control" value="{{ $task->task ?? old('task') ?? '' }}" placeholder="Task name">
        {{ $errors->has('task') ? $errors->first('task') : '' }}
    </div>

    <div class="mb-3">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="date" name="deadline" class="form-control" value="{{ $task->deadline ?? old('deadline') ?? '' }}">
        {{ $errors->has('deadline') ? $errors->first('deadline') : '' }}
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($task->id) ? 'Update' : 'Create' }}</button>

</form>