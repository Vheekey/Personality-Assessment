<?php

namespace App\Http\Controllers;

use App\Http\Services\MultiStep\Steps;
use App\Models\Question;
use Illuminate\Http\Request;

class AssessmentControllerStep5 extends Controller
{
    public function index(Steps $steps)
    {
        $step = $steps->step('assessment.register', 5);

        if ($step->notCompleted(1, 2, 3, 4)) {
            return redirect()->route('assessment.register.1.index');
        }

        $records = Question::with('answers')->paginate(1);


        return view('assessment', compact('step', 'records'));
    }

    public function store(Steps $steps, Request $request)
    {
        $steps->step('assessment.register', 5)
            ->store($request->all())
            ->complete();

        $results = collect($steps->dataBag())->except('_token')->toArray();

        $scores = [];
        foreach (array_values($results) as $answer){
            $values = explode('.', $answer);
            $scores[] = $values[1];
        }

        $total_score = array_sum($scores);

        return view('personality', compact('total_score'));
    }
}
