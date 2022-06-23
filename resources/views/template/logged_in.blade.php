<header class="header">
    <p>Memorize</p>
    <nav class="header_nav">
        <div>
            <p>こんにちは。{{Auth::user()->name}}さん!</p>
        </div>
        <ul>
            <li>
                <p>お気に入り投稿</p>
                <img>
            </li>
            <li>
                <p>フォロワー一覧</p>
                <img>
            </li>
            <li>
                <p>マイページ</p>
                <img>
            </li>
        </ul>
    <nav>
</header>
@endsection