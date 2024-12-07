@extends('layouts.template')

@section('title', 'Contact Enregistré')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Tableau des Notes</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notes as $index => $note)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $note }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Moyenne:</strong> {{ number_format($average, 2) }}</p>
        <p><strong>Mention:</strong> {{ $mention }}</p>
    </div>
@endsection