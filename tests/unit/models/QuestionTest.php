<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ree\Models\Question;
use Ree\Models\User;
use Ree\Models\Answer;

class QuestionTest extends TestCase
{
    /**
     * Test create new Question
     *
     * @return void
     */
    public function testCreate()
    {
        $question = new Question();
        $question->title = 'Demo title';
        $question->content = 'Demo content';
        $count = Question::count();
        $question->save();
        $this->assertEquals(Question::count(), $count + 1);
        $this->assertEquals('Demo title', Question::find($question->_id)->title);
        $this->assertEquals('Demo content', Question::find($question->_id)->content);
        $question->first()->delete();
        $this->assertEquals(Question::count(), $count);
    }
    
    public function testAnswers()
    {
        $question = new Question();
        $question->title = 'New question';
        $question->save();
        $anwser = new Answer();
        $anwser->content = 'You should do that not do this!!!!!!';
        $question->answers()->save($anwser);
        $this->assertEquals($anwser->content, $question->answers()->first()->content);
        $anwser2 = new Answer();
        $anwser2->content = '222 You should do that not do this!!!!!!';
        $question->answers()->save($anwser2);
        $this->assertEquals(2, $question->answers()->count());
    }
    
    public function testPushAnser()
    {
        $anwser = new Answer();
        $anwser->content = 'You should do that not do this!!!!!!';
        $question = new Question();
        $question->answers()->delete();
        $question->save();
        $question->pushAnswer($anwser);
        $this->assertEquals($anwser->content, $question->answers()->first()->content);
        $anwser2 = new Answer();
        $anwser2->content = '222 You should do that not do this!!!!!!';
        $question->pushAnswer($anwser2);
        $this->assertEquals(2, $question->answers()->count());
    }
}
