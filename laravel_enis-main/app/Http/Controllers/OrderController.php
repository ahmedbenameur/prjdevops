<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($date, $num)
    {
        // Parse the date from 'ddmmyyyy' to 'dd/mm/yyyy'
        $formattedDate = substr($date, 0, 2) . '/' . substr($date, 2, 2) . '/' . substr($date, 4, 4);

        return view('order.show', ['date' => $formattedDate, 'num' => $num]);
    }
}
