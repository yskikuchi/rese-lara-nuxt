# プロジェクト名

Rese（リーズ）

## 概要

Rese グループの飲食店予約サービスです。

デモページ: https://rese-lara-nuxt.herokuapp.com

## 機能一覧

### ユーザー

-   会員登録・ログイン
    -   新規会員登録時のメール認証
-   飲食店一覧を表示
    -   ジャンル・エリア・店名で絞り込み
-   お気に入り店舗登録・削除
-   予約機能
    -   日時・人数を指定して予約
    -   予約の削除
    -   予約の変更
-   Stripe による事前決済機能
-   訪れた飲食店の評価機能

### 店舗代表者

-   店舗情報の作成・更新
-   店舗の予約確認
-   店舗画像の追加
-   予約者へのメール送信機能

### 管理者

-   上記店舗代表者の機能
-   店舗代表者の作成

## 環境

-   PHP 7.4.26
-   laravel 8.81.0
-   Nodejs v14.18.0
-   Nuxt v2.15.8
-   MySQL 5.7.34

## インストール

```
$ git clone https://github.com/yskikuchi/rese-lara-nuxt.git
$ cd rese-lara-nuxt
```

### 1. laravel

```
$ composer install
$ cp .env.local.example .env

$ php artisan key:generate
```

env ファイルのデータベースを修正後

```
$ php artisan migrate
$ php artisan db:seed
```

### 2. Nuxt

```
$ cd ../
$ cd nuxt rese-nuxtpj
$ yarn install

$ cp .env.local.example .env
```

### 3.laravel & Nuxt を立ち上げる

```
php artisan serve
yarn dev
```

## Heroku へのデプロイ

データベースはアドオンで ClearDB をインストールし、MySQL を使用できるようにします。

### 前提条件

1. Heroku アカウントを持っている（ない場合は、[こちら](https://signup.heroku.com/)から Heroku への登録を行ってください。)
2. Heroku CLI をインストールしている
3. Heroku マイページにてクレジットカードを登録している（clearDB を利用するのに必要)
4. 上記インストール手順の通りに、ローカル環境でリポジトリを用意している

### デプロイ

1. リポジトリで以下のコマンドを実行

```
$ git init

$ heroku create {アプリ名}

$ git add .
$ git commit -m "message"
$ git push heroku master
```

2. 環境変数の設定


APP_KEY の設定

```
php artisan key:generate --show
```

「base64:xxxx」と出力されるので、そちらを利用して以下のコマンドを入力

```
heroku config:set APP_KEY=base64:xxxx
```

その他環境変数として以下を入力
API_URL={アプリのURL}
API_BASE_URL＝{アプリのURL}/api
APP_URL={アプリのURL}
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=
AWS_BUCKET=
STRIPE_PUBLIC_KEY＝
STRIPE_SECRET_KEY＝
HOME_URL＝{アプリのURL}
HOST=0.0.0.0
NODE_ENV=production
```

3. cleardb の導入

laravel(resepj-api)のリポジトリにて以下を実行

```
heroku addons:add cleardb
heroku config:get CLEARDB_DATABASE_URL
```

「CLEARDB_DATABASE_URL: mysql://[ユーザー名]:[パスワード]@[ホスト名]/[データベース名]?reconnect=true」のような形で結果が出力されるので。以下の設定に利用する

```
heroku config:set DB_USERNAME=ユーザー名
heroku config:set DB_PASSWORD=パスワード
heroku config:set DB_HOST=ホスト名
heroku config:set DB_DATABASE=データベース名
```

設定が確認できたら migrate を実行

```
heroku run php artisan migrate
```
