<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\Models\User;

class RegisterController extends Controller
{
	public function __invoke(RegisterFormRequest $request)
	{
		$user = User::create(array_merge(
			$request->data(),
			['password' => bcrypt($request->password)],
		));

		$token = $user->createToken(config('app.name'));

		return response()->json([
			'token_type' => 'Bearer',
			'token' => $token->plainTextToken,
		], 200);
	}
}