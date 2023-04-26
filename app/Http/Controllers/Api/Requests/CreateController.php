<?php

namespace App\Http\Controllers\Api\Requests;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Requests\CreateFormRequest;
use App\Models\Request as ModelRequest;

class CreateController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(CreateFormRequest $request)
	{
		$data = $request->data();

		$currentRequest = ModelRequest::create($data);
		return $currentRequest;
	}
}
