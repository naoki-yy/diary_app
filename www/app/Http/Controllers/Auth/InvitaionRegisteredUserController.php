<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class InvitaionRegisteredUserController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // user_type 1:一般ユーザ 2:招待されたユーザ
        if ($request->invitation_code) {
            $invitation = Invitation::where('code', $request->invitation_code)->first();

            if (!$invitation || $invitation->status !== 'pending') {
                return redirect()->back()
                 ->with('error', 'この招待コードは無効です。');
            }

            $invitation->status = 'accepted';
            // 招待者
            if ($invitation->inviter_id) {
                $invitation_share_no = $invitation->user->share_no;
            }
            $user->share_no = $invitation_share_no;
            $user->user_type = 2;
        } else {
            $max_share_no = User::max('share_no');
            $next_share_no = $max_share_no ? $max_share_no + 1 : 1;

            $user->share_no = $next_share_no;
            $user->user_type = 1;
        }

        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
