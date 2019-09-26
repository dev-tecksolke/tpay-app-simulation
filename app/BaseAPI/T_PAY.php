<?php


namespace App\BaseAPI;


use App\TPayDeposit;
use App\TPayWithDraw;
use Illuminate\Http\Request;

class T_PAY {
	/**
	 * Create an stk transaction
	 * @param Request $request
	 */
	public static function createSTKTPayTransaction(Request $request): void {
		$referenceCode = $request->input('referenceCode');

		// Create a new query
		$tpayDeposit = TPayDeposit::query();

		// Check if the transaction exists
		$existingTransaction = $tpayDeposit->where('referenceCode', $referenceCode)
			->where('is_paid', false)
			->first();

		if (!$existingTransaction) {
			$tpayDeposit->create([
				'amount' => $request->input('amount'),
				'referenceCode' => $request->input('referenceCode'),
				'phone_number' => $request->input('phone_number'),
				'user_id' => $request->user()->id,
			]);
		}
	}

	/**
	 * Create an stk transaction
	 * @param int $user_id
	 * @param string $phoneNumber
	 * @param string $referenceCode
	 * @param int $amount
	 */
	public static function createWithDrawTransaction(int $user_id, string $phoneNumber, string $referenceCode, int $amount) {
		// Create a new query
		$tpayWithDraw = TPayWithDraw::query();

		$existingTransaction = $tpayWithDraw->where('referenceCode', $referenceCode)->first();
		if (!$existingTransaction) {
			//create a tpay withdraw statements here
			$tpayWithDraw->create([
				'user_id' => $user_id,
				'phone_number' => $phoneNumber,
				'referenceCode' => $referenceCode,
				'amount' => $amount,
			]);
		}
	}
}