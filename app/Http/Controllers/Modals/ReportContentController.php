<?php

namespace App\Http\Controllers\Modals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportContentController extends Controller
{
    //

    public function index(Request $request){;
        return view('modals.report-content', [
            'content_id' => $request->input('content_id'),
            'user_id' => $request->input('user_id'),
        ]);
    }
}
