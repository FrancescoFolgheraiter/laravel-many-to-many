@extends('layouts.app')

@section('page-title', 'Technologies')

@section('main-content')



    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tecnologie utilizzate
                    </h1>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th class="text-end"scope="col" class="text-end">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($technologies as $technology)
                            <tr>
                                <th scope="row">{{ $technology->title }}</th>
                                <td class="d-flex justify-content-end ">
                                    <a href="{{ route('admin.technologies.show', ['technology' => $technology->slug]) }}" class="btn btn-xs btn-primary me-2">
                                        Vedi
                                    </a>
                                    <a href="{{ route('admin.technologies.edit', ['technology' => $technology->slug]) }}" class="btn btn-warning me-2">
                                        Modifica
                                    </a>
                                    <form onsubmit="return confirm('Sei sicuro di voler eliminare questa voce?');"  action="{{ route('admin.technologies.destroy', ['technology' => $technology->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Elimina
                                            </button>
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
