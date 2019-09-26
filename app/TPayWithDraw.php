<?php

namespace App;

use App\Uuids\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TPayWithDraw extends Model {
	use Uuids;
	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;

	//set attributes
	protected $casts = [
		'callback' => 'array',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'phone_number',
		'referenceCode',
		'amount',
		'callback',
		'is_withdrawn',
		'is_reversed',
	];

	/**
	 * get user for this statements
	 * @return BelongsTo
	 */
	public function user() {
		return $this->belongsTo(User::class);
	}
}
