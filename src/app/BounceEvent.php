<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BounceEvent extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bounce_event';

    /**
     * Get the recipient for the event.
     */
    public function recipient()
    {
        return $this->belongsTo('App\Recipient');
    }

    /**
     * The categories that belong to the event.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
