@extends('layouts.app')

@section('page-title',  $type->title.' edit')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Modifica tipo: {{ $type->name }}
                    </h1>
                    <br>
                    <form action="{{ route('admin.types.update', ['type' => $type->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                           <label for="name" class="form-label">Nome tipo:<span class="text-danger">*</span></label>
                           <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome..." maxlength="255" required value="{{ $type->name }}">
                           @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                           @enderror
                        </div>
                        <div class="mb-3">
                           <label for="description" class="form-label">Descrizione</label>
                           <textarea class="form-control" id="description" name="description" rows="3" placeholder="Inserisci la descrizione...">{{ $type->description}}</textarea>
                           @error('description')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                           @enderror
                        </div>
                        <div class="mb-3">
                           <label for="version" class="form-label">Versione</label>
                           <input type="text" class="form-control" id="version" name="version" placeholder="Inserisci l'url dell'immagine..." value="{{ $type->version}}">
                           @error('thumb')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                           @enderror
                        </div>
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
