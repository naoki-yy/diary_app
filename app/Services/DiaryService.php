<?php

namespace App\Services;

use App\Http\Requests\DiaryRequest;
use App\Models\Diary;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class DiaryService
{
    /**
     * @param DiaryRequest $request
     * @return void
     */
    public function addDiary(DiaryRequest $request): void
    {
        $diary = new Diary();
        $diary->user_id = Auth::user()->id;
        $diary->emotion_point = $request->emotion_point;
        $diary->content = $request->content;
        $diary->post_date = CarbonImmutable::today()->format('Y-m-d');
        $diary->save();
    }

    /**
     * @param DiaryRequest $request
     * @param Diary $diary
     * @return void
     */
    public function editDiary(DiaryRequest $request, Diary $diary): void
    {
        $diary->emotion_point = $request->emotion_point;
        $diary->content = $request->content;
        $diary->user_id = Auth::user()->id;

        $diary->save();
    }

    /**
     * @param Diary $diary
     * @return void
     */
    public function deleteDiary(Diary $diary): void
    {
        $diary->delete();
    }
}
