# Catwiについて
Catwi(きゃつい)とは、猫好きによる猫好きのための猫情報専門のSNS(チャットツール)です。<br>
Catwiと呼ばれる半角280文字全角140文字以内のメッセージや画像を投稿できます。 <br>
また、自らのプロフィールに紐づいた、猫ちゃんのプロフィールを登録することも可能です。 

# 動作させるためには（私の制作環境）
ローカルサーバー環境は「MAMP」で準備して、「htdocs」フォルダにここにアップされている「Catwi」ファイルごと放り込みます。<br>
MAMPから「phpMyAdmin」を起動させて「CatwiDB.sql」ファイル内のSQL文で書かれたデータをインポートします。<br>
テーブルもカラムもすべて製作時にデモとして使用したまま残っています。Catwiをブラウザで起動させたら各フォームよりユーザー新規登録やCatwi新規投稿をしてみてください。（画像投稿は必須となっています）<br>

# イチ推し機能
1.「ajax」で「LIKE」機能をつけています。本当はCatwi投稿時にも適用したかったですが、今回はLIKE時のみで。<br>
2.画像投稿の処理をしているコードは、DBに画像自体をアップせずに画像のパスのみをアップさせて<img>の「src」で取得する仕組みが書かれています。小細工がかってて面白いと思います。<br>
