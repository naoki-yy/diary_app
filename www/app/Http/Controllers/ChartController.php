<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaryRequest;
use App\Models\Diary;
use App\Services\DiaryService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChartController extends Controller
{
    public function init(): View
    {
        $diaries = Diary::orderBy('id', 'desc')->get();

        $diaries->map(function ($diary) {
            $diary->post_date = $diary->created_at->format('n/j');

            return $diary;
        });

        return view('TopPage', ['diaries' => $diaries]);
    }
}
