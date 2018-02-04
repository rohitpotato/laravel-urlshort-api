<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use Cache;

class LinkStatsController extends Controller
{
    public function show(Request $request)
    {
    	$code = $request->get('code');

    	$link = Cache::remember("stats.{$code}", 10, function () use ($code) {

    		return Link::bycode($code)->first();
    	});

    	if ($link === null) {

    		return response(null, 200);
    	}

    	return $this->linkResponse($link, [

    			'used_count' => (int) $link->used_count,
    			'requested_count' =>  (int) $link->requested_count,
    			'last_requested' => $link->last_requested->diffForHumans(),
    			'last_used' => $link->last_used ? $link->last_used->diffForHumans() : null,

    		]);
    }
}
