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
                            {{ number_format($disk_usage_overview_size/(1024*1024), 2) }}MB({{ number_format($disk_usage_overview_size) }}B)
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            No of files
                        </div>
                        <div class="col-8">
                            {{ $disk_usage_overview_count }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">File Usage Compositions</div>

                <div class="card-body">
                    @if ($disk_usage_compositions->count() < 0)
                        No data
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">No of files</th>
                                    <th scope="col">Size</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($disk_usage_compositions as $item)
                                <tr>
                                    <th scope="row">{{$item->mime}}</th>
                                    <td>{{$item->count}}</td>
                                    <td>{{ number_format($item->sum/(1024*1024), 2) }}MB({{ number_format($item->sum) }}B)</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
