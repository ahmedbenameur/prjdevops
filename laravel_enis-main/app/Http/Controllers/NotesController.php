<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index()
    {
        $notes = [17, 15, 9, 12];
        $sum = array_sum($notes);
        $count = count($notes);
        $average = $sum / $count;

        switch ($average) {
            case ($average >= 16):
                $mention = 'Très bien';
                break;
            case ($average >= 14):
                $mention = 'Bien';
                break;
            case ($average >= 12):
                $mention = 'Assez bien';
                break;
            case ($average >= 10):
                $mention = 'Passable';
                break;
            default:
                $mention = 'Refusé';
        }

        return view('notes.index', compact('notes', 'average', 'mention'));
    }
}
