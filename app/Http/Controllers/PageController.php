<?php

namespace App\Http\Controllers;

use App\Models\LookerStudio;
use App\Models\NewsUpdate;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('User.index', [
            'newsUpdate' => NewsUpdate::latest('id')->first(),
            'lookerStudio' => LookerStudio::latest('id')->first(),
        ]);
    }

    public function news(): View
    {
        return view('User.kabar', [
            'newsUpdate' => NewsUpdate::latest('id')->first(),
        ]);
    }

    public function services(): View
    {
        return view('User.service');
    }

    public function looker(): View
    {
        return view('User.looker', [
            'lookerStudio' => LookerStudio::latest('id')->first(),
        ]);
    }
}
