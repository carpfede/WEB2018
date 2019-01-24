@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Miembros</h4>
            <a href="{{route('members.create')}}" class="float-right"><i class="fas fa-plus-circle fa-2x text-success"></i></i></a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>E-mail</th>
                            <th>Rol</th>
                            <th>Usuario</th>
                            <th>Deshabilitado</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{$member->firstName}}</td>
                                <td>{{$member->lastName}}</td>
                                <td>{{$member->email}}</td>
                                <td>{{$member->role->name}}</td>
                                <td>{{$member->user->username}}</td>
                                <td class="text-center">
                                    <div class="form-check disabled">
                                        @if($member->user->disabled)
                                            <input type="checkbox" class="form-check-input" checked disabled>
                                        @else
                                            <input type="checkbox" class="form-check-input" disabled>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('members.edit',$member->id)}}"><i class="far fa-edit text-info"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('members.show',$member->id)}}"><i class="far fa-eye text-secondary" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
@endsection
