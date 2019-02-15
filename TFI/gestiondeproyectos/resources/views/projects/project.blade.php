@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card bg-light">
        <div class="card-body">
            <h4 class="card-title">Datos del proyecto</h4>
            <div class="form-group row justify-content-center">
                <label class="col-2 text-right">Nombre</label>
                <div class="col-4">
                    <input type="text" class="form-control form-control-sm" disabled value="{{ $project->name }}">
                </div>
                <label class="col-2 text-right">Nombre Corto</label>
                <div class="col-4">
                    <input type="text" class="form-control form-control-sm" disabled value="{{ $project->shortname }}">
                </div>
            </div>
            <div class="form-group row justify-content-center d-flex">
                <label class="col-2 text-right">Descripción</label>
                <div class="col-10">
                <textarea class="form-control" rows="3" disabled value="{{ $project->description }}"></textarea>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <label class="col-2 text-right">Desde</label>
                <div class="col-4">
                    <input type="date" class="form-control form-control-sm" disabled value="{{ $project->from }}">
                </div>
                <label class="col-2 text-right">Hasta</label>
                <div class="col-4">
                    <input type="date" class="form-control form-control-sm" disabled value="{{ $project->to }}">
                </div>
            </div>
        </div>
    </div>
    <div class="card bg-light">
        <div class="card-body">
            <div class="row">
                <div class="col-2 border-right border-dark">
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <h5 class="card-title" aria-describedby="basic-addon2">Sprints</h5>
                                @if(Auth::user()->isInRole('Admin','Lider de proyecto'))
                                    <div class="input-group-append ml-4">
                                        <a style="cursor:pointer;" data-toggle="modal" data-target="#sprintModal"><i class="fas fa-plus text-success"></i></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @foreach($project->sprints as $s)
                        <div class="row">
                            <div class="col">
                                <div class="list-group">
                                    <a href="{{route('projects.show',[$project->id, $s->id])}}">
                                        <span>{{ $s->version }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-10">
                    @if($sprint != null)
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <h5 class="card-title" aria-describedby="basic-addon2">Tareas</h5>
                                    <div class="input-group-append ml-auto">
                                        <a style="cursor:pointer;" data-toggle="modal" data-target="#taskModal"><i class="fas fa-plus text-success"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Responsable</th>
                                    <th>Tiempo restante</th>
                                    <th>Subtareas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sprint->tasks as $task)
                                    <tr>
                                        <td><a style="cursor:pointer;" data-toggle="modal" data-target="#subtaskModal" data-taskid="{{$task->id}}"><i class="fas fa-plus text-success"></i></a></td>
                                        <td>{{$task->name}}</td>
                                        <td>
                                            <select class="form-control form-control-sm" onChange="updateTask({{$task->id}},this.value)">
                                                <option value="Hacer" {{$task->status == 'Hacer' ? 'selected' : ''}}>Por hacer</option>
                                                <option value="EnProgreso" {{$task->status == 'EnProgreso' ? 'selected' : ''}}>En progreso</option>
                                                <option value="Resuelta" {{$task->status == 'Resuelta' ? 'selected' : ''}}>Resuelta</option>
                                                <option value="Testing" {{$task->status == 'Testing' ? 'selected' : ''}}>Testing</option>
                                                <option value="Cancelada" {{$task->status == 'Cancelada' ? 'selected' : ''}}>Cancelada</option>
                                            </select>
                                            
                                        </td>
                                        <td>{{$task->member->firstName}}</td>
                                        <td>{{$task->remaining()}}</td>
                                        <td><a href="" data-toggle="collapse" data-target="#{{'taskId'.$task->id}}" class="accordion-toggle"><b>{{$task->subtasks->count()}}</b></a></td>
                                    </tr>
                                    @foreach($task->subtasks as $subtask)
                                        <tr>
                                            <td colspan="12" class="hiddenRow">
                                                <div class="collapse" id="{{'taskId'.$task->id}}">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Estimado</th>
                                                                <th>Restante</th>
                                                                <th>Estado</th>
                                                                <th>Asignado a</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><span>{{$subtask->name}}</span></td>
                                                                <td><span>{{$subtask->estimated}}</span></td>
                                                                <td><span>{{$subtask->remaining}}</span></td>
                                                                <td><span>{{$subtask->status}}</span></td>
                                                                <td><span>{{$subtask->member->firstName.' '.$subtask->member->lastName[0].'.'}}</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach  
                                @endforeach
                                @if(!$sprint->tasks->count()>0)
                                    <tr>
                                        <td colspan="12">
                                            <div class="alert alert-primary" role="alert">
                                                No hay tareas
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    @else
                    <div class="alert alert-primary">
                        Seleccione el sprint
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mt-1">
        <a href="{{route('projects.index')}}">Volver al listado</a>
    </div>

    <div class="modal fade" id="sprintModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{route('sprints.store')}}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo sprint</h5>
                        <div class="form-grouop">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
                            <button type="submit" class="close" aria-hidden="true"><i class="far fa-save"></i></button>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" name="project" value="{{ $project->id }}">
                    <div class="modal-body">
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Número</label>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" name="number">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Versión</label>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" name="version">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Desde</label>
                            <div class="col-4">
                                <input type="date" class="form-control form-control-sm" name="from">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Fin estimado</label>
                            <div class="col-4">
                                <input type="date" class="form-control form-control-sm" name="toEstimated">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{route('tasks.store')}}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva tarea</h5>
                        <div class="form-grouop">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
                            <button type="submit" class="close" aria-hidden="true"><i class="far fa-save"></i></button>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" name="sprint" value="{{ @nullsafe($sprint->id) }}">
                    <input type="hidden" name="member" value="{{ Auth::user()->member->id }}">
                    <div class="modal-body">
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Nombre</label>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" name="name">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Prioridad</label>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" name="priority">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Estado</label>
                            <div class="col-4">
                                <select class="form-control" name="status">
                                    <option value="Hacer">Por hacer</option>
                                    <option value="EnProgreso">En progreso</option>
                                    <option value="Resuelta">Resuelta</option>
                                    <option value="Testing">Testing</option>
                                    <option value="Cancelada">Cancelada</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Tipo</label>
                            <div class="col-4">
                                <select class="form-control" name="type">
                                    <option value="NuevaFuncion">Nueva funcionalidad</option>
                                    <option value="Tarea">Tarea</option>
                                    <option value="Error">Error</option>
                                    <option value="Soporte">Soporte</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Descripción</label>
                            <div class="col-4">
                                <textarea class="form-control" rows="3" name="description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="subtaskModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{route('subtasks.store')}}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva Sub-tarea</h5>
                        <div class="form-grouop">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
                            <button type="submit" class="close" aria-hidden="true"><i class="far fa-save"></i></button>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" name="task" id="taskid" value="">
                    <div class="modal-body">
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Nombre</label>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" name="name">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Tiempo estimado</label>
                            <div class="col-4">
                                <input type="number" min="0" step="0.1" class="form-control form-control-sm" name="estimated">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Estado</label>
                            <div class="col-4">
                                <select class="form-control" name="status">
                                    <option value="Hacer">Por hacer</option>
                                    <option value="EnProgreso">En progreso</option>
                                    <option value="Resuelta">Resuelta</option>
                                    <option value="Testing">Testing</option>
                                    <option value="Cancelada">Cancelada</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-3 text-right">Asignado a</label>
                            <div class="col-4">
                                <select class="form-control" name="member">
                                    @foreach($project->members as $member)
                                        <option value="{{$member->id}}">{{$member->lastName.' '.$member->firstName[0].'.'}}</option>
                                    @endforeach    
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#subtaskModal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('taskid');
            $("#taskid").val(id);
        });
    });

    function updateTask (id,item) {
        const dto = {
            'taskId': id,
            'status': item,
            'CSRF': getCSRFTokenValue()
        }
        axios.post('/tasks/update',dto).then();
    }
</script>
@endsection
