<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaryRequest;
use App\Models\Diary;
use App\Models\User;
use App\Services\DiaryService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TopPageController extends Controller
{
    /**
     * 初期表示
     *
     * @return View
     */
    public function init(): View
    {
        $diaries = Diary::where('user_id', Auth::id())
                ->orderBy('id', 'desc')
                ->get();

        $share_user = User::query()
                ->where('id', '!=', Auth::user()->id)
                ->where('share_no', Auth::user()->share_no)
                ->first();

        $share_user_diaries = $share_user ? Diary::where('user_id', $share_user->id)
            ->orderBy('id', 'desc')
            ->get() : collect();

        return view('TopPage', ['diaries' => $diaries, 'share_user' => $share_user, 'share_user_diaries' => $share_user_diaries]);
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
