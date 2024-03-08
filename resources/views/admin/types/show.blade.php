@extends('layouts.app')

@section('page-title', 'Progetto'.$type->name )

@section('main-content')

<div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                       {{ $type->name}}
                    </h1>
                    <hr>
                    <div>
                        @if (!($type->version==null))
                            Versione: {{ $type->version }}
                        @else 
                            Versione: -
                        @endif
                    </div>
                    <div>
                        @if (!($type->description==null))
                            {{ $type->description }}
                        @else 
                            Descrizione: -
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
