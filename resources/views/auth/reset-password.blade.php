<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input name="token" type="hidden" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-3">
            <label class="form-label" for="email">{{ __('メールアドレス') }}</label>
            <input class="form-control" id="email" name="email" type="email"
                :value="old('email', $request - > email)" required autofocus autocomplete="username">
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
                autocomplete="new-password">
            @if ($errors->has('password'))
                <div class="text-danger mt-2">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label class="form-label" for="password_confirmation">{{ __('確認用パスワード') }}</label>
            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" required
                autocomplete="new-password">
            @if ($errors->has('password_confirmation'))
                <div class="text-danger mt-2">
                    {{ $errors->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center justify-content-between mt-4">
            <button class="btn btn-primary" type="submit">
                {{ __('パスワードリセット') }}
            </button>
        </div>
    </form>
</x-guest-layout>
