<?php

namespace Ree\Models;

use Jenssegers\Mongodb\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class ReeObject extends Model
{
    use SoftDeletes;
    
    const VOTE_UP = 0;
    const VOTE_DOWN = 1;
    
    protected $dates = ['deleted_at'];
    protected $beVoted = true;
    
    /**
     * Return owner of this question 
     * 
     * @return  User
     */
    public function owner() {
        return $this->belongsTo('Ree\Models\User')->first();
    }
    
    /**
     * Vote this object
     * 
     * @param User $user
     * @return array
     */
    public function vote($type = ReeObject::VOTE_UP, $user) 
    {
        $vote_type = $type == ReeObject::VOTE_UP ? 'vote_up' : 'vote_down';
        $votes = json_decode($this->{$vote_type}, true);
        if ($votes && in_array($user->id, $votes)) 
        {
            return false;
        }
        $votes[] = $user->id;
        $this->$vote_type = json_encode($votes);
        return $this->save();
    }

    public function voted($type = ReeObject::VOTE_UP)
    {
        $vote_type = $type == ReeObject::VOTE_UP ? 'vote_up' : 'vote_down';
        $votes = json_decode($this->{$vote_type}, true);
        return User::whereIn('_id', $votes);
    }
}
