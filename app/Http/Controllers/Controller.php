<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Link;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function linkResponse(Link $link, $merge=[])
    {
    	return response()->json([

    		'data' => array_merge([

    			'original_url' => $link->original_url,
    			'shortened_url' => $link->shortenedUrl(),
    			'code' => $link->code
    		], $merge)

    		], 200);
    }
}
