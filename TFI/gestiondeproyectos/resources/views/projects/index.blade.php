@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Proyectos</h4>
            @if(Auth::user()->isInRole('Admin','Lider de proyecto'))
                <a href="{{route('projects.create')}}" class="float-right"><i class="fas fa-plus-circle fa-2x text-success"></i></i></a>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Nombre corto</th>
                        <th>Descripción</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Versión</th>
                        <th>Miembros</th>
                        <th>Tareas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$project->name}}</td>
                            <td>{{$project->shortname}}</td>
                            <td><p>{{$project->description}}</p></td>
                            <td>{{$project->from}}</td>
                            <td>{{$project->to}}</td>
                            <td class="text-center">{{@nullsafe($project->sprints->last()->version)}}</td>
                            <td class="text-center"><a class="text-primary" style="cursor:pointer;" data-toggle="modal" data-target="#usersModal-{{$project->id}}"><b>{{$project->members->count()}}</b></a></td>
                            <td class="text-center">{{@nullsafe($project->sprints->last()->tasks->count())}}</td>
                            <td>
                                <a href="{{route('projects.show',$project->id)}}"><i class="far fa-eye text-secondary" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <div class="modal fade" id="usersModal-{{$project->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form action="{{route('project.updateMembers')}}" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Asignar miembros</h5>
                                            <div class="form-grouop">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
                                                @if(Auth::user()->isInRole('Admin','Lider de proyecto'))
                                                    <button type="submit" class="close" aria-hidden="true"><i class="far fa-save"></i></button>
                                                @endif
                                            </div>
                                        </div>
                                        {{ csrf_field() }}
                                        <input type="hidden" name="project" value="{{ $project->id }}">
                                        <div class="modal-body">
                                            <div class="form-group justify-content-center">
                                                <label class="">Miembros</label>
                                                <select multiple name="members[]" size="20" class="form-control" {{Auth::user()->isInRole('Admin','Lider de proyecto') ? '' : 'disabled'}}>
                                                    @foreach($members as $member)
                                                        <option value="{{$member->id}}" {{ $project->members->contains($member->id) ? 'selected' : '' }}>
                                                            {{$member->lastName.' '.$member->firstName[0].'.'}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection