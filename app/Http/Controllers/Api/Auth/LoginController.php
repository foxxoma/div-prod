<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoginController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(Request $request)
	{
		$credentials = $request->only('email', 'password');

		if (!Auth::attempt($credentials)) {
			return response()->json([
				'message' => 'You cannot sign with those credentials',
				'errors' => 'Unauthorised'
			], 401);
		}

		$token = Auth::user()->createToken(config('app.name'));

		return response()->json([
			'token_type' => 'Bearer',
			'token' => $token->plainTextToken,
		], 200);
	}
}
