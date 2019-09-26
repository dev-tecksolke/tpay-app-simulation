<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPayWithDrawsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('t_pay_with_draws', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->unsignedInteger('user_id');
			$table->string('phone_number');
			$table->string('referenceCode')->unique();
			$table->double('amount')->default(0);
			$table->json('callback')->nullable();
			$table->boolean('is_withdrawn')->default(false);
			$table->boolean('is_reversed')->default(false);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('t_pay_with_draws');
	}
}
