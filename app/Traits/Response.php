<?php

namespace App\Traits;
use Illuminate\Contracts\Validation\Validator;

trait Response{

	public function json_response($status, $status_code, $message, $data = NULL, $others = []){
		$response = [
			'status' => $status,
			'message' => $message,
			'data' => $data
		];

		return response()->json(array_merge($response, $others), $status_code);
	}
}