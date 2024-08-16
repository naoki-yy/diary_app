<x-guest-layout>
    <div class="my-2">
        <x-error-success-message :$errors />
    </div>
    <form method="POST" action="{{ route('invitation.register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label" for="name">{{ __('ユーザ名') }}</label>
            <input class="form-control" id="name" name="name" type="text" :value="old('name')" required
                autofocus autocomplete="name">
            @if ($errors->has('name'))
                <div class="text-danger mt-2">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label class="form-label" for="email">{{ __('メールアドレス') }}</label>
            <input class="form-control" id="email" name="email" type="email" :value="old('email')" required
                autocomplete="username">
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
        <!-- Invitation Code (Optional) -->
        <div class="mb-3">
            <label class="form-label" for="invitation_code">{{ __('招待コード (任意)') }}</label>
            <input class="form-control" id="invitation_code" name="invitation_code" type="text"
                value="{{ old('invitation_code', $invitation_code ?? '') }}" autocomplete="invitation-code">
            @if ($errors->has('invitation_code'))
                <div class="text-danger mt-2">
                    {{ $errors->first('invitation_code') }}
                </div>
            @endif
        </div>


        <div class="d-flex align-items-center justify-content-between mt-4">
            <a class="text-primary" href="{{ route('login') }}">
                {{ __('登録済みの方') }}
            </a>

            <button class="btn btn-primary" type="submit">
                {{ __('登録') }}
            </button>
        </div>
    </form>
</x-guest-layout>
