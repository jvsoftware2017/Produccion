@extends('layouts.app')
@section('title', 'Siemens Monitor')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Bienvenido <small> al sistema de monitoreo.</small></h3>
					{{ csrf_field() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection