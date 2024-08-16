<?php

namespace App\Http\Controllers;

use App\Mail\InviteUserMail;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Str;


class InvitationController extends Controller
{
    public function init():View
    {
        return view('Invitation');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // 既に一人招待済みの場合は、これ以上の招待不可
        $exist_share_no = User::query()
                            ->where('id', '!=', Auth::user()->id)
                            ->where('share_no', Auth::user()->share_no)
                            ->exists();

        if ($exist_share_no) {
            return redirect()->route('invite.send')->with('error', '既に一度招待を行ったことがあります。');
        }

        $invitation = new Invitation();
        $invitation->code = Str::random(10);
        $invitation->inviter_id = Auth::id();
        $invitation->invitee_email = $request->email;
        $invitation->save();

        Mail::to($request->email)->send(new InviteUserMail($invitation));

        return back()->with('success', '招待メールを送信しました');
    }

    public function accept($code)
    {
        $invitation = Invitation::where('code', $code)->first();

        if (!$invitation || $invitation->status !== 'pending') {
            return redirect()->route('login')->with('error', 'この招待コードは無効です。');
        }

        // if (Auth::check()) {
        //     // 既にログインしている場合、ダッシュボードなどにリダイレクトする
        //     return redirect()->route('dashboard');
        // }

        // 招待者用のログインページへ
        return view('auth.invitationRegister', ['invitaion_code' => $code]);
    }
}
