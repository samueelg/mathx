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

    public function generateExercise(Request $request): View
    {
        $request->validate([
            'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division',
            'check_division' => 'required_without_all:check_subtraction,check_multiplication,check_sum',
            'check_subtraction' => 'required_without_all:check_sum,check_multiplication,check_division',
            'check_multiplication' => 'required_without_all:check_subtraction,check_sum,check_division',
            'number_one' => 'required|integer|min:0|max:999|lt:number_two',
            'number_two' => 'required|integer|min:0|max:999',
            'number_exercises' => 'required|integer|min:5|max:50',
        ]);

        $operations = [];

        if($request->check_sum){ $operarions[] = 'sum';}
        if($request->check_subtraction){ $operations[] = 'subtraction';}
        if($request->check_division){ $operations[] = 'division';}
        if($request->check_multiplication){ $operations[] = 'multiplication';}


        $min = $request->number_one;
        $max = $request->number_two;

        $numberExercises = $request->number_exercises;

        $exercises = [];
        for($index = 1; $index <= $numberExercises; $index++){
            $operation = $operations[array_rand($operations)];
            $number1 = rand($min,$max);
            $number2 = rand($min,$max);

            $exercise = '';
            $sollution = '';

            switch($operation){
                case 'sum':
                    $exercise = "$number1 + $number2 =";
                    $solution = $number1 + $number2;
                    break;
                case 'subtraction':
                    $exercise = "$number1 - $number2 =";
                    $sollution = $number1 - $number2;
                    break;
                case 'division':
                    if($number2 == 0){
                        $number2 = 1;
                    }
                    $exercise = "$number1 : $number2 =";
                    $sollution = $number1 / $number2;
                    break;
                case 'multiplication':
                    $exercise = "$number1 x $number2 =";
                    $sollution = $number1 * $number2;
                    break;
            }
            if(is_float($sollution)){
                $sollution = round($sollution,2);
            }
            
            $exercises[] = [
                'operation' => $operation,
                'exercise_number' => $index,
                'exercise' => $exercise,
                'sollution' => "$exercise $sollution"
            ];

        }

        return view('operations', ['exercises' => $exercises]);
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
