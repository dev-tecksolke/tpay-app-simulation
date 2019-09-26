<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'phoneNumber',
		'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];


	/**
	 * get all request for t_pay_deposits here
	 * @return HasMany
	 */
	public function t_pay_deposit() {
		return $this->hasMany(TPayDeposit::class);
	}

	/**
	 * get all request t_pay_with_draws
	 * @return HasMany
	 */
	public function t_pay_with_draw() {
		return $this->hasMany(TPayWithDraw::class);
	}
}
