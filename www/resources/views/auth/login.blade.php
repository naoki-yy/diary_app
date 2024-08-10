<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label class="form-label" for="email">{{ __('メールアドレス') }}</label>
            <input class="form-control" id="email" name="email" type="email" :value="old('email')" required
                autofocus autocomplete="username">
            @if ($errors->has('email'))
                <div class="text-danger mt-2">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label" for="password">{{ __('パスワード') }}</label>
            <input class="form-control" id="password" name="password" type="password" required
                autocomplete="current-password">
            @if ($errors->has('password'))
                <div class="text-danger mt-2">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input class="form-check-input" id="remember_me" name="remember" type="checkbox">
            <label class="form-check-label" for="remember_me">
                {{ __('ログイン情報を記憶する') }}
            </label>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-4">
            @if (Route::has('password.request'))
                <a class="text-primary" href="{{ route('password.request') }}">
                    {{ __('パスワードを忘れた方') }}
                </a>
            @endif

            <button class="btn btn-primary" type="submit">
                {{ __('ログイン') }}
            </button>
        </div>
    </form>
</x-guest-layout>
