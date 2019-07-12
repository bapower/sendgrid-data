<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = ['email', 'salesforce_id', 'created_at', 'updated_at'];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recipient';

    /**
     * Get the bounce event for this recipient.
     */
    public function bounceEvent()
    {
        return $this->hasMany('App\BounceEvent');
    }

    /**
     * Get the click event for this recipient.
     */
    public function clickEvent()
    {
        return $this->hasMany('App\ClickEvent');
    }

	/**
     * Get the deferred event for this recipient.
     */
    public function deferredEvent()
    {
        return $this->hasMany('App\DeferredEvent');
    }

    /**
     * Get the delivered event for this recipient.
     */
    public function deliveredEvent()
    {
        return $this->hasMany('App\DeliveredEvent');
    }

    /**
     * Get the dropped event for this recipient.
     */
    public function droppedEvent()
    {
        return $this->hasMany('App\DroppedEvent');
    }

    /**
     * Get the Open event for this recipient.
     */
    public function openEvent()
    {
        return $this->hasMany('App\OpenEvent');
    }

    /**
     * Get the processed event for this recipient.
     */
    public function processedEvent()
    {
        return $this->hasMany('App\ProcessedEvent');
    }

    /**
     * Get the spam report event for this recipient.
     */
    public function spamReportEvent()
    {
        return $this->hasMany('App\SpamReportEvent');
    }

    /**
     * Get the unsubscribe event for this recipient.
     */
    public function unsubscribeEvent()
    {
        return $this->hasMany('App\UnsubscribeEvent');
    }
}
