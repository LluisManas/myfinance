@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('status'))
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                    
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div id='app'>
        <app-component></app-component>
    </div>
</div>
@endsection
