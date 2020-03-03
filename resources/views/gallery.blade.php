@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-header">Gallery</div>
                    <div class="card-body">
                        <gallery-component></gallery-component>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
