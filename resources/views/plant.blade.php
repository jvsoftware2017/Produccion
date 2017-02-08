
@extends('layouts.app')
@section('title', 'Siemens Monitor')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">

        <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Administrador de Plantas(Sedes)</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="text-muted font-13 m-b-30">
                                Aquí podrás Ver, Modificar, Eliminar, Crear Plantas según tu Rol
                            <p align="right"><button  class="btn btn-round btm-warning">Crear</button></p>
                            </div>

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                    <th>Fecha Registro</th>
                                    <th>Fecha Modificación</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($dataPlant as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->id_client}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->adress}}</td>
                                        <td>{{$row->id_city}}</td>
                                        <td>{{$row->created_at}}</td>
                                        <td>{{$row->updated_at}}</td>
                                        <td>Activo</td>
                                        <td><button class="btn btn-round btm-warning">Editar</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
