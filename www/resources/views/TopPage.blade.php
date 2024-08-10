<x-layouts.mainLayout>
    <div class="container">
        <div class="my-2">
            <x-error-success-message :$errors />
        </div>
        <div class="border border-dark mt-3">
            <div class="d-flex align-items-center justify-content-center mt-3 mb-2">
                <img src="{{ asset('assets/images/kokoro.png') }}" alt="logo" width="32px" height="32px">
                <div class="text-center fs-3 ms-3">今日は何があった？</div>
            </div>
            <div class="w-25 mx-auto rounded" style="border-bottom: 6px solid #ff8484;"></div>
            <form action="{{ route('top.add') }}" method="POST">
                @csrf
                <div class="row d-flex justify-content-center align-items-center my-5">
                    <div class="ms-5 me-4 col-2">
                        <select class="form-select form-control-lg" name="emotion_point"
                            aria-label="Default select example" required>
                            <option class="text-center" selected>-- 選択 --</option>
                            <option class="text-center" value="10">+ 5</option>
                            <option class="text-center" value="9">+ 4</option>
                            <option class="text-center" value="8">+ 3</option>
                            <option class="text-center" value="7">+ 2</option>
                            <option class="text-center" value="6">+ 1</option>
                            <option class="text-center" value="5"> 0</option>
                            <option class="text-center" value="4">- 1</option>
                            <option class="text-center" value="3">- 2</option>
                            <option class="text-center" value="2">- 3</option>
                            <option class="text-center" value="1">- 4</option>
                            <option class="text-center" value="0">- 5</option>
                        </select>
                    </div>
                    <div class="me-4 col-7">
                        <input class="form-control form-control-lg" name="content" type="text"
                            aria-label="form-control-lg example" placeholder="今日やったこと、出来事、気持ち、気分" required>
                    </div>
                    <div class="col-2 ms-2">
                        <button class="btn btn-primary px-4" type="submit">送信</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-flex my-3 message-box">
            <div class="flex-fill border border-dark p-0">
                <div class="border-bottom border-black py-2 text-center">
                    <div class="fw-bold fs-4">userB</div>
                </div>
                <div class="inner-container w-100">
                    <table class="table table-hover">
                        <thead>
                            <td class="text-center">日付</td>
                            <td class="text-center">感情ポイント</td>
                            <td class="text-center">出来事・気持ち</td>
                            <td></td>
                            <td></td>
                        </thead>
                        <tbody>
                            @foreach ($diaries as $diary)
                                <tr>
                                    <td class="text-center">
                                        <span>{{ $diary->formatted_date }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span>{{ $diary->emotion_point }}点</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="ms-3">{{ $diary->content }}</span>
                                    </td>
                                    <td>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex-fill border border-dark p-0">
                <div class="border-bottom border-black py-2 text-center">
                    <div class="fw-bold fs-4">userA</div>
                </div>
                <div class="inner-container w-100">
                    <table class="table table-hover">
                        <thead>
                            <td class="text-center">日付</td>
                            <td class="text-center">感情ポイント</td>
                            <td class="text-center">出来事・気持ち</td>
                            <td></td>
                            <td></td>
                        </thead>
                        <tbody>
                            @foreach ($diaries as $index => $diary)
                                <form action="{{ route('diary.update', $diary) }}" method="POST">
                                    @csrf
                                    <tr>
                                        <td class="text-center">
                                            <span>{{ $diary->formatted_date }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span>{{ $diary->emotion_point }}点</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="ms-3">{{ $diary->content }}</span>
                                        </td>
                                        <td>
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; margin: 0;">
                                                <i class="bi bi-pencil-fill cursor-pointer">
                                                </i>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="submit"
                                                style="background: none; border: none; padding: 0; margin: 0;">
                                                <i class="bi bi-trash3 cursor-pointer">
                                                </i>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            function updateButton() {

            }

            function deleteButton(diaryId) {
                // 削除ボタンがクリックされたときの処理
                console.log('Delete Diary ID: ', diaryId);
                // 実際の処理をここに記述
            }
        </script>
    @endpush
</x-layouts.mainLayout>
