<?php

namespace App\Http\Controllers;

use App\Http\Services\MultiStep\Steps;
use App\Models\Question;
use Illuminate\Http\Request;

class AssessmentControllerStep3 extends Controller
{
    public function index(Steps $steps)
    {
        $step = $steps->step('assessment.register', 3);

        if ($step->notCompleted(1, 2)) {
            return redirect()->route('assessment.register.1.index');
        }

        $records = Question::with('answers')->paginate(1);


        return view('assessment', compact('step', 'records'));
    }

    public function store(Steps $steps, Request $request)
    {
        $steps->step('assessment.register', 3)
            ->store($request->all())
            ->complete();

        return redirect()->route('assessment.register.4.index', 'page=4');
    }
}
