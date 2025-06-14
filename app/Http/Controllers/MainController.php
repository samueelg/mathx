<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function generateExercise(Request $request)
    {
        $request->validate([
            'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division',
            'check_division' => 'required_without_all:check_subtraction,check_multiplication,check_sum',
            'check_subtraction' => 'required_without_all:check_sum,check_multiplication,check_division',
            'check_multiplication' => 'required_without_all:check_subtraction,check_sum,check_division',
            'number_two' => 'required|integer|min:0|max:999',
            'number_one' => 'required|integer|min:0|max:999',
            'number_exercises' => 'required|integer|min:5|max:50',
        ]);
        dd($request->all());
    }
        public function printExercises()
    {
        echo 'imprimir exercicios no navegador';
    }
        public function exportExercise()
    {
        echo 'exportar exercicios para um arquivo';
    }
}
