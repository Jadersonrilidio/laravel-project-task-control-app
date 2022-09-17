@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                     <div class="row">
                        <div class="col-4">
                            {{ __('Dashboard') }}
                        </div>

                        <div class="col-8">
                            <a href="{{ route('task.index') }}" style="float:right; margin-left:15px">Return</a>
                        </div>
                    </div>    
                </div>

                <div class="card-body">

                    <span class="row justify-content-center" style="font-size:1.3em; color:white; background-color:lightgreen">
                        {{ $message ?? '' }}
                    </span>

                    @component('task._components.form-create-edit')
                    @endcomponent

                </div>
            </div>
        </div>
    </div>
</div>
@endsection