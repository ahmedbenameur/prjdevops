@extends('layouts.template')

@section('title', 'Contact Enregistré')

@section('content')
    <div class="container mt-5">
        @if($success)
            <div class="alert alert-success">
                {{ $success }}
            </div>
        @endif

        <h1 class="mb-4">Informations de Contact</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text"><strong>Nom:</strong> {{ $nom }}</p>
                <p class="card-text"><strong>Prénom:</strong> {{ $prenom }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $email }}</p>
                <p class="card-text"><strong>Message:</strong> {{ $message }}</p>
            </div>
        </div>
    </div>
@endsection