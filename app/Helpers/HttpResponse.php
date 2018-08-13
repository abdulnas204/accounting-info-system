<?php

namespace App\Helpers;


class HttpResponse 
{
	public static function success($message='success')
	{
		$response = [
			"code" => 200,
			"message" => $message,
		];
		return $response;
	}

	public static function error($message)
	{
		$response = [
			"code" => 500,
			"message" => $message
		];
		return $response;
	}
}
