<?php

namespace App\Services;

use App\Http\Requests\DiaryRequest;
use App\Models\Diary;
use Illuminate\Support\Facades\Auth;

class DiaryService
{
    public function addDiary(DiaryRequest $request)
    {
        $diary = new Diary();
        $diary->user_id = Auth::user()->id;
        $diary->emotion_point = $request->emotion_point;
        $diary->content = $request->content;

        $diary->save();
    }
}
