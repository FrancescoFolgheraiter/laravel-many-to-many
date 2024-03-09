@extends('layouts.app')

@section('page-title', 'Aggiungi-una-tecnologia')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Aggiungi una tecnologia
                    </h1>
                    <br>
                    <form action="{{ route('admin.technologies.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                           <label for="title" class="form-label">Nome della tecnologia <span class="text-danger">*</span></label>
                           <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci il nome..." maxlength="255" required value="{{ old('title') }}">
                           @error('title')
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
