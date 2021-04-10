<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaticController extends Controller
{
    //

    public function About(){
        $data['title'] = 'About Retail Diligence';

        $data['content'] = Storage::disk('static')->get('about.md');

        return view('static', $data);
    }

    public function Terms(){
        $data['title'] = 'Terms of Use';

        $data['content'] = Storage::disk('static')->get('terms.md');

        return view('static', $data);
    }

    public function Markdown(){
        $data['title'] = 'How To Use Markdown';

        return view('static.markdown', $data);
    }

    public function Privacy(){
        $data['title'] = 'Privacy Policy';

        $data['content'] = Storage::disk('static')->get('privacy.md');

        return view('static', $data);
    }
}
