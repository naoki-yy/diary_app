<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ChartController extends Controller
{
    /**
     * 折れ線グラフ表示
     *
     * @return View
     */
    public function init(): View
    {
        $oneMonthAgo = now()->subMonth();

        $diaries = Diary::where('user_id', Auth::id())
            ->where('post_date', '>=', $oneMonthAgo)
            ->orderBy('id', 'desc')
            ->get();

        $diaries->map(function ($diary) {
            $diary->post_date = Carbon::parse($diary->post_date)->format('n/j');

            return $diary;
        });

        $labels = $diaries->pluck('post_date')->unique()->values()->toArray();

        // ラベル表示のための並び順を逆にする
        $labels = array_reverse($labels);

        $data = [];

        foreach ($labels as $label) {
            $data[] = $diaries->where('post_date', $label)->avg('emotion_point');
        }

        return view('Chart', ['diaries' => $diaries, 'data' => $data, 'labels' => $labels]);
    }
}
