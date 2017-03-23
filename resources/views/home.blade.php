@extends('layouts.app')
@section('title', 'DriveSysMonitor')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h1>DriveSysMonitor</h1>
                    <h4>Bienvenido, {{ Auth::user()->name}}</h4>
                    <p>Tu licencia es válida hasta el: <b>{{ Auth::user()->client->dateValidity }}</b></p>
					{{ csrf_field() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection