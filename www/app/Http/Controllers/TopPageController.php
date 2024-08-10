<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaryRequest;
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
            $diary->post_date = $diary->created_at->format('n/j');

            return $diary;
        });

        return view('TopPage', ['diaries' => $diaries]);
    }

    /**
     * 日記登録
     *
     * @param DiaryRequest $request
     * @param DiaryService $diary
     * @return RedirectResponse
     */
    public function add(DiaryRequest $request, DiaryService $diary): RedirectResponse
    {
        try {
            $diary->addDiary($request);
            return redirect()->route('top.init')->with('success', '登録に成功しました');
        } catch (Exception $e) {
            return redirect()->route('top.init')->with('error', '登録に失敗しました: ' . $e->getMessage());
        }
    }

    /**
     * 日記編集
     *
     * @param DiaryRequest $request
     * @param Diary $diary
     * @param DiaryService $diary_service
     * @return RedirectResponse
     */
    public function edit(DiaryRequest $request, Diary $diary, DiaryService $diary_service): RedirectResponse
    {
        try {
            $diary_service->editDiary($request, $diary);
            return redirect()->route('top.init')->with('success', '更新に成功しました');
        } catch (Exception $e) {
            return redirect()->route('top.init')->with('error', '更新に失敗しました: ' . $e->getMessage());
        }
    }

    /**
     * 日記削除
     *
     * @param Diary $diary
     * @param DiaryService $diary_service
     * @return RedirectResponse
     */
    public function destroy(Diary $diary, DiaryService $diary_service): RedirectResponse
    {
        try {
            $diary_service->deleteDiary($diary);
            return redirect()->route('top.init')->with('success', '削除に成功しました');
        } catch (Exception $e) {
            return redirect()->route('top.init')->with('error', '削除に失敗しました: ' . $e->getMessage());
        }
    }
}
