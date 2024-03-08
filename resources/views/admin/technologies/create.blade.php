@extends('layouts.app')

@section('page-title', 'Aggiungi-tipo')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Aggiungi tipo
                    </h1>
                    <br>
                    <form action="{{ route('admin.types.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                           <label for="name" class="form-label">Nome del tipo <span class="text-danger">*</span></label>
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
                           <label for="version" class="form-label">Versione</label>
                           <input type="text" class="form-control" id="version" name="version" placeholder="Inserisci l'url dell'immagine..." value="{{ old('version') }}">
                           @error('thumb')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                           @enderror
                        </div>
                        <div>
                           <button type="submit" class="btn btn-success w-100">
                                 + Aggiungi
                           </button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection
