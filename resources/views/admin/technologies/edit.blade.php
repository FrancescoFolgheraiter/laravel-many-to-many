@extends('layouts.app')

@section('page-title',  $technology->title.' edit')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Modifica la tecnologia: {{ $technology->title }}
                    </h1>
                    <br>
                    <form action="{{ route('admin.technologies.update', ['technology' => $technology->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                           <label for="title" class="form-label">Nome della tecnologia:<span class="text-danger">*</span></label>
                           <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" title="title" placeholder="Inserisci il nome..." maxlength="255" required value="{{ $technology->title }}">
                           @error('title')
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
