<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ココロDiary招待メール</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #ff6f61;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 20px 0;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 25px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .footer {
            font-size: 14px;
            color: #888;
            margin-top: 30px;
            text-align: center;
        }
        .code-container {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>ココロDiary利用の招待メールが届きました！</h1>
        <p>下記のボタンから利用手続きを開始してください。</p>

        <div class="button-container">
            <a href="{{ route('invitation.accept', ['code' => $invitation->code]) }}" class="button">
                招待を受け入れる
            </a>
        </div>

        <p>リンク先で問題が発生した場合は、次の招待コードをご利用ください。</p>
        <div class="code-container">
            {{ $invitation->code }}
        </div>

        <div class="footer">
            <p>このメールはココロDiaryからの自動送信です。返信しないでください。</p>
        </div>
    </div>
</body>
</html>
