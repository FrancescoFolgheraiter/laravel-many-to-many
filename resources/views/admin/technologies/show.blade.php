@extends('layouts.app')

@section('page-title', 'Progetto'.$technology->title )

@section('main-content')

<div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                       {{ $technology->title}}
                    </h1>
                    <hr>
                    <h2 class="text-center">
                        Tutti i progetti associati a questa tecnologia
                    </h2>
                    <ul>
                        @foreach ($technology->projects as $project)
                            <li>
                                <a href="{{ route('admin.projects.show', ['project' => $project->id]) }}">
                                    {{ $project->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
