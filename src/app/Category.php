<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'created_at', 'updated_at'];
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * The bounce events that belong to the category.
     */
    public function bounceEvents()
    {
        return $this->belongsToMany('App\BounceEvent');
    }

    /**
     * The click events that belong to the category.
     */
    public function clickEvents()
    {
        return $this->belongsToMany('App\ClickEvent');
    }

    /**
     * The deferred events that belong to the category.
     */
    public function deferredEvents()
    {
        return $this->belongsToMany('App\DeferredEvent');
    }

    /**
     * The delivered events that belong to the category.
     */
    public function deliveredEvents()
    {
        return $this->belongsToMany('App\DeliveredEvent');
    }

    /**
     * The dropped events that belong to the category.
     */
    public function droppedEvents()
    {
        return $this->belongsToMany('App\DroppedEvent');
    }

    /**
     * The open events that belong to the category.
     */
    public function openEvents()
    {
        return $this->belongsToMany('App\OpenEvent');
    }

    /**
     * The processed events that belong to the category.
     */
    public function processedEvents()
    {
        return $this->belongsToMany('App\ProcessedEvent');
    }

    /**
     * The spam report events that belong to the category.
     */
    public function spamReportEvents()
    {
        return $this->belongsToMany('App\SpamReportEvent');
    }

    /**
     * The unsubscribe events that belong to the category.
     */
    public function unsubscribeEvents()
    {
        return $this->belongsToMany('App\UnsubscribeEvent');
    }
}
