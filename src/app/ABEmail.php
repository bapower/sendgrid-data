<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ABEmail extends Model
{
	protected $fillable = ['group_id', 'group_designation', 'created_at', 'updated_at'];
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'ab_email';
}
