<x-layouts.mainLayout>
    <div class="container">
        <div class="border border-dark mt-3">
            <div class="text-center mt-3 fs-3">今日は何があった？</div>
            <div class="row d-flex justify-content-center align-items-center my-5">
                <div class="ms-5 me-4 col-1">
                    <select class="form-select form-control-lg" aria-label="Default select example">
                        <option selected></option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="me-4 col-8">
                    <input class="form-control form-control-lg" type="text" aria-label=".form-control-lg example"
                        placeholder="今日やったこと、出来事、気持ち、気分">
                </div>
                <div class="col-2 ms-2">
                    <button class="btn btn-primary px-4" type="submit">送信</button>
                </div>
            </div>
        </div>
        <div class="d-flex my-3 message-box">
            <div class="flex-fill border border-dark p-0">
                <div class="border-bottom border-black py-2 text-center mb-3">
                    <div class="fw-bold fs-4">userB</div>
                </div>
                <div class="inner-container mt-4 mx-auto">
                    <div class="bg-secondary">a</div>
                </div>
            </div>
            <div class="flex-fill border border-dark p-0">
                <div class="border-bottom border-black py-2 text-center mb-3">
                    <div class="fw-bold fs-4">userA</div>
                </div>
                <div class="inner-container mt-4 mx-auto">
                    <div class="bg-secondary">
                        a
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.mainLayout>
