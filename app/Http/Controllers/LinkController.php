<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use Cache;
use Carbon\Carbon;

class LinkController extends Controller
{
    public function show(Request $request) {

        $code = $request->code;

       $link = Link::bycode($link)->first();

        if($link === null) {

            return response(null, 404);
        }

        $link->increment('used_count');
        $link->update(['last_used' => Carbon::now()]);

        return $this->linkResponse($link);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [

    			'url' => 'required|url'

    		], [

    				'url.required' => 'Please enter a url to shorten',
    				'url.url' => 'Oops! That doesnot look like a valid url'
    		]);

    	$link = Link::firstOrNew([

    			'original_url' => $request->get('url'),


    		]);

    	if (!$link->exists) {

    		$link->save();
    		$link->update([

    			'code' => $link->getCode()

    			]);
    	}

    	$link->increment('requested_count');

    	return $this->linkResponse($link);
    }
}
