<?php

namespace Ree\Models;

use Jenssegers\Mongodb\Model;

class Question extends Model
{
    /**
     * Return owner of this question 
     * 
     * @return  User
     */
    public function owner() {
        return $this->belongsTo('User');
    }
    
    /**
     * Push a Answer to this question
     * 
     * @param Answer $answer
     * @return array
     */
    public function pushAnswer($answer) {
        if (!$this->answers) {
            $this->answers = [];
        }
        $this->answers[]  = $answer;
        return $answer;
    }
    
    /**
     * Push a comment to this question
     * 
     * @param Comment $comment
     * @return array
     */
    public function pushComment($comment) {
        if (!$this->comments) {
            $this->comments = [];
        }
        $this->comments[] = $comment;
        return $comment;
    }
    
    /**
     * Get all comments of this question
     * 
     * @return array
     */
    public function comments() {
        return $this->embedsMany('Comment');
    }
    
    /**
     * Get all answers of this question
     * 
     * @return array
     */
    public function answers() {
        return $this->embedsMany('Answer');
    }
    
    /**
     * Vote up this question
     * 
     * @param User $user
     * @return array
     */
    public function voteUp($user) {
        if (!$this->voteUps) {
            $this->voteUps = [];
        }
        // TODO
        // Check user voted
        $this->voteUps[] = $user;
        return $this->voteUps;
    }
    
    /**
     * Vote down this question
     * 
     * @return array
     */
    public function voteDown($user) {
        if (!$this->voteDowns) {
            $this->voteDowns = [];
        }
        // TODO
        // Check user voted
        $this->voteDowns[] = $user;
        return $this->voteDowns;
    }
}
