<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ree\Models\ReeObject;
use Ree\Models\User;

class ReeObjectTest extends TestCase
{
    public function testOwner()
    {
        $owner = factory(User::class)->make();
        $owner->email = 'ezral@lol.com';
        $owner->save();
        $question = new ReeObject();
        $question->title = 'Test owner';
        $question->owner_id = $owner->id;
        $question->save();
        $qId = $question->id;
        $this->assertEquals('ezral@lol.com', ReeObject::find($qId)->owner()->email);
    }
    
    public function testVote()
    {
        $up = factory(User::class)->make();
        $up->email = 'up@lol.com';
        $up->save();
        $down = factory(User::class)->make();
        $down->email = 'down@lol.com';
        $down->save();
        $question = new ReeObject();
        $question->title = 'Title of question';
        $question->save();
        $question->vote(ReeObject::VOTE_UP, $up);
        $question->vote(ReeObject::VOTE_UP, $up);
        $question->vote(ReeObject::VOTE_UP, $down);
        $question->vote(ReeObject::VOTE_DOWN, $down);
        $question->vote(ReeObject::VOTE_DOWN, $down);
        $up = json_decode($question->vote_up, true);
        $down = json_decode($question->vote_down, true);
        $this->assertEquals(2, count($up));
        $this->assertEquals(1, count($down));
    }
    
    public function testVoted()
    {
        $up = factory(User::class)->make();
        $up->email = 'up@lol.com';
        $up->save();
        $down = factory(User::class)->make();
        $down->email = 'down@lol.com';
        $down->save();
        $question = new ReeObject();
        $question->title = 'Title of question';
        $question->save();
        $question->vote(ReeObject::VOTE_UP, $up);
        $question->vote(ReeObject::VOTE_UP, $down);
        $emails = [];
        foreach($question->voted(ReeObject::VOTE_UP)->get() as $user)
        {
            $emails[] = $user->email;
        }
        $this->assertEquals(['up@lol.com', 'down@lol.com'], $emails);
    }
}
