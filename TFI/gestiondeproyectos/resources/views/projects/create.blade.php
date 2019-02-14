@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Nuevo Proyecto</h4>
            <form class="mt-2" action="{{route('projects.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row justify-content-center">
                    <label class="col-2 text-right">Nombre</label>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-sm" name="name">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label class="col-2 text-right">Nombre Corto</label>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-sm" name="shortname">
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <label class="col-2 text-right">Descripción</label>
                    <div class="col-4">
                        <textarea class="form-control" rows="3" name="description"></textarea>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label class="col-2 text-right">Desde</label>
                    <div class="col-4">
                        <input type="date" class="form-control form-control-sm" name="from">
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <label class="col-2 text-right">Hasta</label>
                    <div class="col-4">
                        <input type="date" class="form-control form-control-sm" name="to">
                    </div>
                </div>
                <div class="form-group row justify-content-center d-flex">
                    <input type="submit" class="btn btn-primary" value="Guardar"/>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-1">
        <a href="{{route('projects.index')}}">Volver al listado</a>
    </div>
</div>
@endsection
