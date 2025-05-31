<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $user['username'] }}のosu!プロフィール</title>
</head>
<body>
    <h1>{{ $user['username'] }}のosu!プロフィール</h1>
    <img src="{{ $user['avatar_url'] }}" alt="Avatar" width="100">

    <ul>
        <li>国: {{ $user['country']['name'] ?? '不明' }}</li>
        <li>プレイ回数: {{ number_format($user['statistics']['play_count']) }}</li>
        <li>ランクスコア: {{ number_format($user['statistics']['ranked_score']) }}</li>
        <li>総スコア: {{ number_format($user['statistics']['total_score']) }}</li>
        <li>グレード統計:
            <ul>
                <li>SS: {{ $user['statistics']['grade_counts']['ss'] }}</li>
                <li>SSH: {{ $user['statistics']['grade_counts']['ssh'] }}</li>
                <li>S: {{ $user['statistics']['grade_counts']['s'] }}</li>
                <li>SH: {{ $user['statistics']['grade_counts']['sh'] }}</li>
                <li>A: {{ $user['statistics']['grade_counts']['a'] }}</li>
            </ul>
        </li>
    </ul>
</body>
</html>
