<?php

namespace App\Http\Controllers;

use App\Http\Requests\addDiaryRequest;
use App\Services\DiaryService;
use Illuminate\View\View;

class TopPageController extends Controller
{
    public function init(): View
    {
        return view('TopPage');
    }

    public function add(addDiaryRequest $request, DiaryService $diary)
    {
        $diary->addDiary($request);
    }
}
