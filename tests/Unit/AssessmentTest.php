<?php

namespace Tests\Unit;

use App\Models\Question;
use Tests\TestCase;

class AssessmentTest extends TestCase
{
    /**
     * Assert that the number of questions created correspond to those returned
     *
     * @return void
     */
    public function test_that_the_number_of_questions_created_is_returned()
    {
        $db_count = Question::count();
        $count = 5;
        if($db_count < 5){
            $total_count = $db_count + $count;
            $questions = Question::factory($count)->create();
        }else{
            $total_count = $db_count;
        }

        $current_db_count = Question::count();

        $this->assertEquals($total_count, $current_db_count);
    }

    /**
     * Assert that personality result is correct
     *
     * @return void
     */
    public function test_that_the_personality_is_properly_calculated()
    {
        $view = $this->view('personality', ['total_score' => 50]);

        $view->assertSeeText('Extrovert', $escaped = true);

        $view = $this->view('personality', ['total_score' => 15]);

        $view->assertSeeText('Introvert', $escaped = true);
    }

    /**
     * Assert that personality result page gives result
     *
     * @return void
     */
    public function test_that_the_personality_result_page_contains_result()
    {
        $view = $this->view('personality', ['total_score' => 25]);

        $view->assertSeeText('Result', $escaped = true);
    }
}
