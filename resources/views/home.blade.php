@extends('layouts.app')
@section('title', 'DriveSysMonitor')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h1>DriveSysMonitor</h1>
                    @if(!(Gate::allows('developer', Auth::user()) || Gate::allows('admin', Auth::user())))
                    	<h2>Tu licencia es válida hasta el: <b>{{ Auth::user()->client->dateValidity }}</b></h2>
                    @endif
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Cambiar password?</h2>
                            <div class="clearfix"></div>
                            <div class="x_content">
                            <br />
                            En la parte superior derecha, en el link de tu pertíl, puedes cambiar tu password!.
                            </div>
                          </div>
					{{ csrf_field() }}
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
