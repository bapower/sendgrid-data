<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpamReportEvent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spam_report_event';

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
