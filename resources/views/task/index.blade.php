@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    <div class="row">
                        <div class="col-4">
                            {{ __("Task list") }}
                        </div>
                        <div class="col-8">
                            <a href="{{ route('task.create') }}" style="float:right; margin-left:15px">New</a>
                            <a href="{{ route('task.export', ['extension' => 'xlsx']) }}" style="float:right; margin-left:15px">XLSX</a>
                            <a href="{{ route('task.export', ['extension' => 'csv']) }}" style="float:right; margin-left:15px">CSV</a>
                            <a href="{{ route('task.export', ['extension' => 'pdf']) }}" style="float:right; margin-left:15px">PDF</a>
                            <a href="{{ route('task.pdf') }}" style="float:right; margin-left:15px" target="_blank">PDF V2</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        
                        <table class="table">

                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">Deadline</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($list as $task)
                                    <tr scope="row">
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->task }}</td>
                                        <td>{{ date('d/m/Y', strtotime($task->deadline)) }}</td>
                                        <td><a href="{{ route('task.show', $task->id) }}" class="btn btn-secondary">Show</a></td>
                                        <td><a href="{{ route('task.edit', $task->id) }}" class="btn btn-primary">Edit</a></td>
                                        <td>
                                            <form id="form_del_{{$task->id}}" action="{{ route('task.destroy', $task->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="btn btn-danger" onclick="document.getElementById('form_del_{{$task->id}}').submit()">Delete</a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        
                        </table>

                    </div>

                    @component('task._components.pagination', [
                        'list' => $list,
                        ])
                    @endcomponent

                </div>
            </div>
        </div>
    </div>
</div>
@endsection