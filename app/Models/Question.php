<?php

namespace Ree\Models;

use Jenssegers\Mongodb\Model;

class Question extends Model
{
    
    protected $fillable = ['title', 'content', 'owner', 'voteUps', 'voteDowns', 'answers', 'comments'];
    /**
     * Return owner of this question 
     * 
     * @return  User
     */
    public function owner() {
        return $this->belongsTo('Ree\Models\User')->first();
    }
    
    /**
     * Push a Answer to this question
     * 
     * @param Answer $answer
     * @return array
     */
    public function pushAnswer($answer) {
        if ($answer->_id)
        {
            return false;
        }
        else
        {
            $this->answers()->save($answer);   
        }
    }
    
    /**
     * Push a comment to this question
     * 
     * @param Comment $comment
     * @return array
     */
    public function pushComment($comment) {
        if ($comment->_id)
        {
            return false;
        }
        else
        {
            $this->answers()->save($comment);   
        }
    }
    
    /**
     * Get all comments of this question
     * 
     * @return array
     */
    public function comments() {
        return $this->embedsMany('Ree\Models\Comment');
    }
    
    /**
     * Get all answers of this question
     * 
     * @return array
     */
    public function answers() {
        return $this->embedsMany('Ree\Models\Answer');
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
