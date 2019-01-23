@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Roles</h4>
            <a href="{{route('roles.create')}}" class="float-right"><i class="fas fa-plus-circle fa-2x text-success"></i></i></a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Sistema</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td><p>{{$role->description}}</p></td>
                            <td class="text-center">
                                <div class="form-check disabled">
                                    @if($role->system)
                                        <input type="checkbox" class="form-check-input" checked disabled>
                                    @else
                                        <input type="checkbox" class="form-check-input" disabled>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($role->system)
                                    <i class="far fa-times-circle text-info" data-toggle="tooltip" data-placement="top" title="No se puede editar"></i>                                
                                @else
                                    <a href="{{route('roles.edit',$role->id)}}"><i class="far fa-edit text-info"></i></a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('roles.show',$role->id)}}"><i class="far fa-eye text-secondary" aria-hidden="true"></i></a>
                            </td>
                            <td>
                                @if(!$role->system)
                                    <a href="{{route('roles.delete', $role->id)}}"><i class="far fa-trash-alt text-danger"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>  
@endsection
