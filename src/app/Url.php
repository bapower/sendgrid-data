<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['url', 'url_type_id', 'created_at', 'updated_at'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'url';

    /**
     * Get the url type for this url.
     */
    public function urlType()
    {
        return $this->belongsTo('App\UrlType');
    }
}
