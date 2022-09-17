@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                     <div class="row">
                        <div class="col-4">
                            {{ $task->task }}
                        </div>

                        <div class="col-8">
                            <a href="{{ route('task.index') }}" style="float:right; margin-left:15px">Return</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <fieldset disabled>
                        <div class="mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date" class="form-control" value="{{ $task->deadline }}">
                        </div>
                    </fieldset>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Return</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection