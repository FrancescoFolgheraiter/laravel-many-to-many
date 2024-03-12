@extends('layouts.app')

@section('page-title', 'Progetto'.$project->name )

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
                        Progetto: {{ $project->name}}
                    </h1>
                    <hr>
                    @if ($project->thumb != null)
                        <div class="my-3">
                            <img src="{{ asset('storage/'.$project->thumb) }}" style="max-width: 400px;">
                        </div>
                    @endif
                    <p class="card-text">{{ $project->description}}</p>
                    <div class="d-flex justify-content-between ">
                        <div>
                            <h5>Tipo di progetto</h5>
                            <h5>
                                @if (!($project->type==null))
                                    {{ $project->type->name}}
                                @else 
                                -
                                @endif
                            </h5>
                        </div>
                        <div>
                            <h5>Totale ore di lavoro</h5>
                            <h5 class="tex">{{ $project->total_hours }}</h5>
                        </div>
                        <div>
                            <h5>Tempistiche</h5>
                            <ul>
                                <li>
                                    Data inizio progetto: {{ Carbon::createFromFormat('Y-m-d', $project->start_date)->format('d-m-Y') }}
                                </li>
                                @if (!($project->last_update_date==null))
                                    <li>
                                       Data ultimo aggiornamento: {{ Carbon::createFromFormat('Y-m-d', $project->last_update_date)->format('d-m-Y') }}
                                    </li> 
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
