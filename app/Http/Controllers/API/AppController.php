<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\TPayDeposit;
use App\TPayWithDraw;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class AppController extends Controller {
	/**
	 * instance of controller
	 */
	public function __construct() {
		//any middleware you want
	}

	/**
	 * receive stk push callbacks here
	 * @param Request $request
	 * @return JsonResponse
	 * @throws Exception
	 */
	public function stkC2BCallBack(Request $request) {
		// Extract the request data and parse it to json
		$response = json_decode($request->getContent());

		//log the response here
		self::log([
			'callback' => $response,
		], 'STK', 'tpay.c2b.deposit.callback');

		// Get the reference code use
		$referenceCode = $response->data->referenceCode;

		// Find the transaction using the reference code
		$tpayDeposit = TPayDeposit::query()->where('referenceCode', $referenceCode)->with('user')->first();

		// Check the transaction status
		if ($response->success) {
			//process with your functions here

			return response()->json([
				'success' => true,
			], 200);
		}

		//do something else here.
		return response()->json([
			'success' => false,
		], 200);
	}


	/**
	 * process the withdraw callback here
	 * @param Request $request
	 * @return JsonResponse
	 * @throws Exception
	 */
	public function withdrawB2CCallBack(Request $request) {
		// Extract the request data and parse it to json
		$response = json_decode($request->getContent());

		//log the response here
		self::log([
			'callback' => $response,
		], 'STK', 'tpay.b2c.withdraw.callback');

		// Get the reference code use
		$referenceCode = $response->data->referenceCode;

		//Fetch This
		$tpay_with_draw = TPayWithDraw::query()->where('referenceCode', $response->data->referenceCode)
			->where('is_withdrawn', false)->with('user')->first();

		if ($response->success) {
			//process with your functions here

			return response()->json([
				'success' => true,
			], 200);
		}

		//do something else here.
		return response()->json([
			'success' => false,
		], 200);
	}


	/**
	 * Write the system log files
	 * @param array $data
	 * @param string $channel
	 * @param string $dir
	 * @throws Exception
	 */
	public static function log(array $data, string $channel, string $dir) {

		$date = date('Y-m-d');
		$file = storage_path('logs/' . $dir . '.log');

		// finally, create a formatter
		$formatter = new JsonFormatter();

		// Create a handler
		$stream = new StreamHandler($file, Logger::INFO);
		$stream->setFormatter($formatter);

		// bind it to a logger object
		$securityLogger = new Logger($channel);
		$securityLogger->pushHandler($stream);
		$securityLogger->addInfo('info', $data);

	}

}
