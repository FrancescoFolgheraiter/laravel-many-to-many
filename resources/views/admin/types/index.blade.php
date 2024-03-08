@extends('layouts.app')

@section('page-title', 'Types')

@section('main-content')



    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tipi utilizzati
                    </h1>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Versione</th>
                                <th class="text-end"scope="col" class="text-end">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                            <tr>
                                <th scope="row">{{ $type->name }}</th>
                                <td>
                                    @if (!($type->version==null))
                                    {{ $type->version }}
                                    @else 
                                    -
                                    @endif
                                </td>
                                <td class="d-flex justify-content-end ">
                                    <a href="{{ route('admin.types.show', ['type' => $type->id]) }}" class="btn btn-xs btn-primary me-2">
                                        Vedi
                                    </a>
                                    <a href="{{ route('admin.types.edit', ['type' => $type->id]) }}" class="btn btn-warning me-2">
                                        Modifica
                                    </a>
                                    <form onsubmit="return confirm('Sei sicuro di voler eliminare questa voce?');"  action="{{ route('admin.types.destroy', ['type' => $type->id]) }}" method="POST">
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
