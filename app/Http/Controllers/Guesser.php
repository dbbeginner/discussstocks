<?php

namespace App\Http\Controllers;

use App\Models\Channels;
use http\Client\Response;
use Illuminate\Http\Request;
use App\Models\Content;
use Vinkla\Hashids\Facades\Hashids;

class Guesser extends Controller
{
    // We make short URL's for social sharing - which are TLD / hashId()
    //
    // This controller provides a 301 redirect to the page being referenced on the site.

    public function guessByHashId($hashId) {
        $destination = Channels::where('id', '=', Hashids::decode($hashId))->first();

        if(!$destination) {
            abort(404);
        }
        return redirect($destination->url(), 301);
    }

}
