@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card mb-2">
                <div class="card-header">Disk Usage</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            Total Size
                        </div>
                        <div class="col-8">
                            xx.xxMB(x,xxxB)
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            No of files
                        </div>
                        <div class="col-8">
                            6
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">File Usage Compositions</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">No of files</th>
                                <th scope="col">Size</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">image/jpeg</th>
                                <td>4</td>
                                <td>xx.xxMB(x,xxxB)</td>
                            </tr>
                            <tr>
                                <th scope="row">image/png</th>
                                <td>2</td>
                                <td>xx.xxMB(x,xxxB)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
