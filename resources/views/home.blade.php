@extends('layouts.app')
@section('title', 'DriveSysMonitor')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>DriveSysMonitor</h3>
					{{ csrf_field() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection