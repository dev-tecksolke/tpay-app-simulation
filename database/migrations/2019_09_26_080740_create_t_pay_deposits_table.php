<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPayDepositsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('t_pay_deposits', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->unsignedInteger('user_id');
			$table->string('referenceCode')->unique();
			$table->double('amount', 2);
			$table->unsignedBigInteger('phone_number');
			$table->json('callback')->nullable();
			$table->boolean('is_paid')->default(false);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('t_pay_deposits');
	}
}
