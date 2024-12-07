<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function save(Request $request)
    {
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $email = $request->input('email');
        $message = $request->input('message');

        return view('contact_save', compact('nom', 'prenom', 'email', 'message'))
            ->with('success', 'Votre message a bien été envoyé !');
    }
}