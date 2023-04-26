<?php

namespace App\Http\Controllers\Api\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request as ModelRequest;

class FindController extends Controller
{
	public function __invoke(Request $request)
	{
		return ModelRequest::findOrFail($request->id);
	}
}
