<?php

namespace App\Http\Controllers\Api\Requests;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Requests\SelectFormRequest;
use Illuminate\Http\Request;
use App\Models\Request as ModelRequest;

class SelectController extends Controller
{
	public function __invoke(SelectFormRequest $request)
	{
		$query = false;
		$data = $request->data();

		if (!empty($data['page']) )
		{
			$page = $data['page']??false;
			$count = !empty($data['count'])?$data['count']:10;

			$query = ModelRequest::skip(($page-1)*$count)->take($count);
		}

		if (!empty($data['sort']) && is_array($data['sort']))
		{
			$sortFields = $request->sortFields();

			foreach ($data['sort'] as $field => $sort)
			{
				if (!in_array($field, $sortFields))
                	continue;

                if (empty($query))
                	$query = ModelRequest::orderBy($field, $sort);
                else
					$query->orderBy($field, $sort);
			}
		}

		if (empty($query))
			return ModelRequest::get();

		return $query->get();
	}
}
