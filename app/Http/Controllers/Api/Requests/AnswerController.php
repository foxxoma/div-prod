<?php

namespace App\Http\Controllers\Api\Requests;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Requests\AnswerFormRequest;
use App\Models\Request as ModelRequest;
use App\Help\Email;

class AnswerController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(AnswerFormRequest $request)
	{
		$data = $request->data();

		$currentRequest = ModelRequest::findOrFail($data['id']);

		$email = new Email($currentRequest['email'], $currentRequest['comment']);

		if ($email->send()['success'] !== true)
			return false;

		$currentRequest->comment = $data['comment'];
		$currentRequest->status = 'Resolved';

		return $currentRequest->update();
	}
}
