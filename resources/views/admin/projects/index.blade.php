@extends('layouts.app')

@section('page-title', 'Progetti-realizzati')

@section('main-content')
{{-- importazione carbon --}}
@php
    use Carbon\Carbon;
@endphp

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Progetti realizzati
                    </h1>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Tipo di progetto</th>
                                <th scope="col">Tecnologie</th>
                                <th scope="col">Data inizio</th>
                                <th scope="col">Ultimo aggiornamento</th>
                                <th scope="col">Totale ore</th>
                                <th colspan="3" class="text-center"scope="col">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                            <tr>
                                <th scope="row" class="w-25 ">{{ $project->name }}</th>
                                <td>
                                    @if (!($project->type==null))
                                    <a href="{{ route('admin.types.show', ['type' => $project->type->id])  }}">
                                        {{ $project->type->name}}
                                    </a>
                                    @else 
                                    -
                                    @endif
                                </td>
                                <td>
                                    @forelse ($project->technologies as $technology)
                                        <a href="{{ route('admin.technologies.show', ['technology' => $technology->slug]) }}" class="badge rounded-pill text-bg-primary">
                                            {{ $technology->title }}
                                        </a>
                                    @empty
                                        -
                                    @endforelse
                                </td>
                                <td>{{ Carbon::createFromFormat('Y-m-d', $project->start_date)->format('d-m-Y')}}</td>
                                <td>
                                    @if (!($project->last_update_date==null))
                                    {{ Carbon::createFromFormat('Y-m-d', $project->last_update_date)->format('d-m-Y') }}
                                    @endif
                                </td>
                                <td>{{ $project->total_hours }}</td>
                                <td>
                                    <a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}" class="btn btn-xs btn-primary me-2">
                                        Vedi
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.projects.edit', ['project' => $project->slug]) }}" class="btn btn-warning me-2">
                                        Modifica
                                    </a>
                                </td>
                                <td>
                                    <form onsubmit="return confirm('Sei sicuro di voler eliminare questa voce?');"  action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Elimina
                                            </button>
                                        @error('name')
                                            <div class="alert alert-danger">
                                                    {{ $message }}
                                            </div>
                                        @enderror
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection
