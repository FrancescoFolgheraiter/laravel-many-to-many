@extends('layouts.app')

@section('page-title', 'Aggiungi-progetto')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Aggiungi progetto
                    </h1>
                    <br>
                    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                           <label for="name" class="form-label">Nome del progetto <span class="text-danger">*</span></label>
                           <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome..." maxlength="255" required value="{{ old('name') }}">
                           @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                           @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Inserisci la descrizione...">{{ old('description') }}</textarea>
                            @error('description')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="thumb" class="form-label">Carica l'immagine del progetto</label>
                            <input class="form-control" type="file" id="thumb" name="thumb">
                            {{-- gestione errore --}}
                            @error('thumb')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type_id" class="form-label">Tipo di progetto<span class="text-danger">*</span></label>
                            <select name="type_id" id="type_id" class="form-select" required>
                                <option value="" {{ old('type_id') == null ? 'selected' : '' }}>
                                    Seleziona una categoria...
                                </option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
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
                           <input type="date" class="form-control" id="start_date" name="start_date"  required value="{{ old('start_date') }}">
                           @error('start_date')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                           @enderror
                        </div>
                        <div class="mb-3">
                            <label for="last_update_date" class="form-label">Data ultimo aggiornamento</label>
                            <input type="date" class="form-control" id="last_update_date" name="last_update_date"  value="{{ old('last_update_date') }}">
                            @error('last_update_date')
                                 <div class="alert alert-danger">
                                     {{ $message }}
                                 </div>
                            @enderror
                         </div>
                        <div class="mb-3">
                            <label for="total_hours" class="form-label">Ore totali di progetto (formato ##.#):</label>
                            <input type="number" step="0.1" class="form-control" id="total_hours" name="total_hours" placeholder="##.#" min="0.5" max="999.99" value="{{ old('total_hours') }}">
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
                                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}
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
                           <button type="submit" class="btn btn-success w-100">
                                Aggiungi
                           </button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
