<?php

namespace App\Http\Controllers;

use App\Models\Channels;
use http\Client\Response;
use Illuminate\Http\Request;
use App\Models\Content;
use Vinkla\Hashids\Facades\Hashids;

class Guesser extends Controller
{
    //

    public function guessByHashId($hashid) {
        $destination = Channels::where('id', '=', Hashids::decode($hashid))->first();

        if(!$destination) {
            abort(404);
        }
        return redirect($destination->url(), 301);
    }

}
