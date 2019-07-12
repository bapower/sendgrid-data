<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlType extends Model
{
	protected $fillable = ['type', 'created_at', 'updated_at'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'url_type';
}
