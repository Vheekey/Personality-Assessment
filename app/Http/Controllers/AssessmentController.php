<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index(Request $request)
    {
        $records = Question::with('answers')->paginate(1);

        return view('assessment', compact('records'));
    }

    public function calculatePersonality(Request $request)
    {
        dd($request->all());
    }
}
