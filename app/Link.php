<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use App\Exceptions\CodeGenerationException;

class Link extends Model
{
   protected $guarded = [];

   protected $dates = [

         'last_requested',
         'last_used',
   ];

   public static function boot() {

      parent::boot();

      static::created( function ($link) {

            $link->update(['last_requested' => Carbon\Carbon::now()]);

      });
   }

   public function getCode()
   {
   		if ($this->id === null) {

   			throw new CodeGenerationException;
   		}	

   		return (new Math)->tobase($this->id);
   }

   public static function bycode($code) {

   		return static::where('code', $code);
   }

   public function shortenedUrl()
   {
   		if ($this->code === null) {

   			return null;
   		}

         return env('CLIENT_URL') . '/' .$this->code;
   }
}
