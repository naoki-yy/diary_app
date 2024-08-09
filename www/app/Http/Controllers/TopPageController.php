<?php

namespace App\Http\Controllers;

use App\Http\Requests\addDiaryRequest;
use App\Models\Diary;
use App\Services\DiaryService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TopPageController extends Controller
{
    public function init(): View
    {
        $diaries = Diary::orderBy('id', 'desc')->get();

        $diaries->map(function ($diary) {
            $diary->formatted_date = $diary->created_at->format('n/j');

            return $diary;
        });

        return view('TopPage', ['diaries' => $diaries]);
    }

    public function add(addDiaryRequest $request, DiaryService $diary): RedirectResponse
    {
        try {
            $diary->addDiary($request);
            return redirect()->route('top.init')->with('success', '登録に成功しました');
        } catch (Exception $e) {
            return redirect()->route('top.init')->with('error', '登録に失敗しました: ' . $e->getMessage());
        }
    }
}
