@extends('layouts.app')

@section('page-title',  $project->title.' edit')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Modifica progetto: {{ $project->name }}
                    </h1>
                    <br>
                    <form action="{{ route('admin.projects.update', ['project' => $project->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                           <label for="name" class="form-label">Nome del progetto <span class="text-danger">*</span></label>
                           <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome..." maxlength="255" required value="{{ $project->name }}">
                           @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                           @enderror
                        </div>
                        <div class="mb-3">
                           <label for="description" class="form-label">Descrizione</label>
                           <textarea class="form-control" id="description" name="description" rows="3" placeholder="Inserisci la descrizione...">{{ $project->description}}</textarea>
                           @error('description')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                           @enderror
                        </div>
                        <div class="mb-3">
                            <label for="thumb" class="form-label">Carica l'immagine del progetto</label>
                            <input class="form-control" type="file" id="thumb" name="thumb">
                            {{-- controllo se devo visualizzare l'immagine nel caso sia valorizzato project->thumb --}}
                            @if ($project->thumb != null)
                                <div class="mt-2">
                                    <h4>
                                        immagine progetto attuale:
                                    </h4>
                                    <img src="/storage/{{ $project->thumb }}" style="max-width: 400px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="delete_img" name="delete_img">
                                        <label class="form-check-label" for="delete_img">
                                            Rimuovi immagine
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @error('thumb')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type_id" class="form-label">Tipo di progetto</label>
                            <select name="type_id" id="type_id" class="form-select">
                                <option {{ old('type_id', $project->type_id) == null ? 'selected' : '' }} value="">
                                    Seleziona una categoria...
                                </option>
                                @foreach ($types as $type)
                                    <option {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }} value="{{ $type->id }}">
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> 
                        <div class="mb-3">
                           <label for="start_date" class="form-label">Data inizio progetto <span class="text-danger">*</span></label>
                           <input type="date" class="form-control" id="start_date" name="start_date"  required value="{{ $project->start_date }}">
                           @error('start_date')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                           @enderror
                        </div>
                        <div class="mb-3">
                            <label for="last_update_date" class="form-label">Data ultimo aggiornamento</label>
                            <input type="date" class="form-control" id="last_update_date" name="last_update_date"  value="{{ $project->last_update_date }}">
                            @error('last_update_date')
                                 <div class="alert alert-danger">
                                     {{ $message }}
                                 </div>
                            @enderror
                         </div>
                        <div class="mb-3">
                            <label for="total_hours" class="form-label">Ore totali di progetto (formato ##.#):</label>
                            <input type="number" step="0.1" class="form-control" id="total_hours" name="total_hours" placeholder="##.#" min="0.5" max="999.99" value="{{ $project->total_hours }}">
                            @error('total_hours')
                                 <div class="alert alert-danger">
                                     {{ $message }}
                                 </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tecnologie</label>
            
                            <div>
                                @foreach ($technologies as $technology)
                                    <div class="form-check form-check-inline">
                                        <input
                                            {{-- Se c'è l'old, vuol dire che c'è stato un errore --}}
                                            @if ($errors->any())
                                                {{-- Faccio le verifiche sull'old --}}
                                                {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}
                                            @else
                                                {{-- Faccio le verifiche sulla collezione --}}
                                                {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}
                                            @endif
                                            class="form-check-input"
                                            type="checkbox"
                                            id="technology-{{ $technology->id }}"
                                            name="technologies[]"
                                            value="{{ $technology->id }}">
                                        <label class="form-check-label" for="technology-{{ $technology->id }}">{{ $technology->title }}</label>
                                    </div>
                                    @endforeach
                                    @error('technologies')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        <div>
                           <button type="submit" class="btn btn-warning w-100">
                                 Modifica
                           </button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
