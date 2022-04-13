<?php

namespace Tests\Feature;

use App\Http\Controllers\AssessmentControllerStep1;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonalityTest extends TestCase
{
    /**
     * Assert that assessment page contains assessment
     *
     * @return void
     */
    public function test_assessment_view_has_assessment()
    {
        $response = $this->get(url('assessment/personality/1'));

        $response->assertViewHas('records');
    }

    /**
     * Assert that a user is redirected to first page while trying to assess the result directly
     *
     * @return void
     */
    public function test_redirection_when_assessment_is_incomplete()
    {
        $count = Question::count();

        $response = $this->get(url('assessment/personality/'.$count));

        $response->assertRedirect();

        $response->assertRedirect(url('assessment/personality/1'));
    }

    /**
     * Test that a user is redirected on d=going to the domain url
     *
     * @return void
     */
    public function redirection_when_domain_is_assessed()
    {
        $response = $this->get(url('/'));

        $response->assertRedirect();
    }
}
