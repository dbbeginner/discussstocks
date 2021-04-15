<?php

namespace App\Http\Controllers\Modals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlaggedContent;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Content;

class ReportContentController extends Controller
{
    //

    public function index(Request $request){
        return view('modals.report-content', [
            'content_id' => $request->input('content_id'),
            'reporter_id' => $request->input('reporter_id')
        ]);
    }

    public function store(Request $request){
        $content_id = Hashids::decode( $request->input('content_id') )[0];
        $reporter_id = Hashids::decode( $request->input('reporter_id') )[0];
        $user_id = Content::where('id', '=', $content_id)->first()->user_id;
        $reason = $request->input('reason');

        return FlaggedContent::create([
            'content_id' => $content_id,
            'reporter_id' => $reporter_id,
            'user_id' => $user_id,
            'reason' => $reason
        ]);

    }
}
