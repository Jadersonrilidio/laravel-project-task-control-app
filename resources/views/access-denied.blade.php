@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">
                    {{ __('Access denied') }}
                </div>

                <div class="card-body">
                    {{ __('Sorry, you do not have access to this resource') }}
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
