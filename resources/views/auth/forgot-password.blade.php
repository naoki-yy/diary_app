<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('メールアドレスをご入力ください。パスワードリセットリンクをメールにお送りします。') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label class="form-label" for="email">{{ __('メールアドレス') }}</label>
            <input class="form-control" id="email" name="email" type="email" :value="old('email')" required
                autofocus>
            @if ($errors->has('email'))
                <div class="text-danger mt-2">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center justify-content-center mt-4">
            <button class="btn btn-primary" type="submit">
                {{ __('送信') }}
            </button>
        </div>
    </form>
</x-guest-layout>
