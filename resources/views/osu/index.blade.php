<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>osu! Bランク数チェック</title>
</head>

<body>
    <h1>osu! Bランクチェック</h1>
    <form method="POST" action="/osu">
        @csrf
        <input type="text" name="username" placeholder="osu!ユーザー名" required>
        <button type="submit">チェック</button>
    </form>

    @isset($bCount)
        <p>{{ $username }} さんの最近100プレイ中のBランク数：<strong>{{ $bCount }}</strong></p>
    @endisset

    @if (isset($bCount))
        <p>Bランク数：{{ $bCount }}</p>
    @elseif(isset($error))
        <p style="color: red;">{{ $error }}</p>
    @endif

</body>

</html>
