<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use http\Client\Response;
use Illuminate\Http\Request;
use App\Models\Content;
use Vinkla\Hashids\Facades\Hashids;

class Guesser extends Controller
{
    // We make short URL's for social sharing - which are TLD / hashId()
    //
    // This controller provides a 301 redirect to the page being referenced on the site.

    public function guessByHashId($hash_id) {
        $destination = Channel::where('id', '=', Hashids::decode($hash_id))->first();

        if(!$destination) {
            abort(404);
        }
        return redirect($destination->url(), 301);
    }

}
