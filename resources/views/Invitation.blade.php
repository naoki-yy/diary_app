<x-layouts.mainLayout>
    <div class="container">
        <div class="my-2">
            <x-error-success-message :$errors />
        </div>
        <div>
            <div class="fs-2">招待コード送信 <span class="fs-6 ms-2">ー 交換日記をする相手に招待コードを送信できます ー</span></div>
        </div>
        <div class="my-5 w-50">
            <form action="{{ route('invite.email') }}" method="POST">
            @csrf
                <label class="mb-3 fw-bold">E-mailアドレス</label>
                <div class="d-flex">
                    <input type="email" name="email" class="form-control me-4" style="width: 80%">
                    <button type="submit" class="btn btn-primary">送信</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.mainLayout>
