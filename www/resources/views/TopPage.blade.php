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
            <div class="flex-fill border border-dark p-0" style="overflow-y: auto;">
                <div class="border-bottom border-black py-2 text-center bg-white"
                    style="position: sticky; top: 0; height: 45px;">
                    <div class="fw-bold fs-4">userB</div>
                </div>
                <div class="inner-container w-100">
                    <table class="table table-hover">
                        <thead style="position: sticky; top: 45px;">
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
                                        <span>{{ $diary->post_date }}</span>
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
            <div class="flex-fill border border-dark p-0" style="overflow-y: auto;">
                <div class="border-bottom border-black py-2 text-center bg-white"
                    style="position: sticky; top: 0; height: 45px;">
                    <div class="fw-bold fs-4">{{ Auth::user()->name }}</div>
                </div>
                <div class="inner-container w-100">
                    <table class="table table-hover">
                        <thead style="position: sticky; top: 45px;">
                            <td class="text-center">日付</td>
                            <td class="text-center">感情ポイント</td>
                            <td class="text-center">出来事・気持ち</td>
                            <td></td>
                            <td></td>
                        </thead>
                        <tbody>
                            @foreach ($diaries as $index => $diary)
                                <tr>
                                    <td class="text-center">
                                        <span>{{ $diary->post_date }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            id="emotion_point_content-{{ $index }}">{{ $diary->emotion_point }}</span><span>点</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="ms-3"
                                            id="text_content-{{ $index }}">{{ $diary->content }}</span>
                                    </td>
                                    <td>
                                        <button id="update-button-{{ $index }}"
                                            data-diary-id="{{ $diary->id }}"
                                            style="background: none; border: none; padding: 0; margin: 0;"
                                            onclick="updateButton({{ $index }})">
                                            <i class="bi bi-pencil-fill cursor-pointer"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button id="delete-button-{{ $index }}"
                                            data-diary-id="{{ $diary->id }}"
                                            style="background: none; border: none; padding: 0; margin: 0;"
                                            onclick="deleteButton({{ $index }})">
                                            <i class="bi bi-trash3 cursor-pointer"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- 編集モーダル --}}
    <div class="modal fade" id="editDiaryModal" aria-labelledby="editDiaryModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="editDiaryModalLabel">日記の編集</h5>
                    <button class="btn-close bg-white" data-bs-dismiss="modal" type="button"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editDiaryForm" method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="modal_emotion_point">感情ポイント</label>
                            <select class="form-select form-control w-25" id="modal_emotion_point"
                                name="emotion_point" aria-label="Default select example" required>
                                <option class="text-center">-- 選択 --</option>
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
                        <div class="mb-3">
                            <label class="form-label" for="modal_content">出来事・気持ち</label>
                            <input class="form-control" id="modal_content" name="content" type='text'
                                value=''>
                        </div>
                        <button class="btn btn-primary" type="submit">更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- 削除モーダル --}}
    <div class="modal fade" id="deleteDiaryModal" aria-labelledby="deleteDiaryModalLabel" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteDiaryForm" method="POST" action="">
                    @csrf
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="deleteDiaryModalLabel">削除確認</h5>
                        <button class="btn-close bg-white" data-bs-dismiss="modal" type="button"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>削除してもよろしいですか？</div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">キャンセル</button>
                        <button class="btn btn-danger" type="submit">削除</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @push('scripts')
        <script>
            const document_root_url = "{{ config('app.url') }}";

            function updateButton(index) {
                const button = $(`#update-button-${index}`);
                const diaryId = button.data('diary-id');

                const emotion_point_text = $(`#emotion_point_content-${index}`).text();
                const text_content_text = $(`#text_content-${index}`).text();

                const modal = new bootstrap.Modal(document.getElementById('editDiaryModal'));
                $('#modal_emotion_point').val(emotion_point_text);
                $('#modal_content').attr('value', text_content_text);
                modal.show();

                const edit_url = `${document_root_url}/diary/${diaryId}/edit`;
                $('#editDiaryForm').attr('action', edit_url);
            }

            function deleteButton(index) {
                const button = $(`#delete-button-${index}`);
                const diaryId = button.data('diary-id');

                const modal = new bootstrap.Modal(document.getElementById('deleteDiaryModal'));
                modal.show();

                const edit_url = `${document_root_url}/diary/${diaryId}/delete`;
                $('#deleteDiaryForm').attr('action', edit_url);
            }
        </script>
    @endpush
</x-layouts.mainLayout>
