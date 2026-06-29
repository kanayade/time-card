# time-card

## 環境構築
### リポジトリの設定
```
% mkdir time-card
% cd time-card
% git clone https://github.com/kanayade/time-card
```
オリジナルのリモートリポジトリを作成し、リモートリポジトリのurlを変更する。<br>
```
% git remote set-url origin 作成したリポジトリのurl
% git remote -v
```
ローカルリポジトリの内容をリモートに反映させる。<br>
```
% git add .
% git commit -m "リモートリポジトリの変更"
% git push origin main
```
### Dockerの設定
```
% docker-compose up -d --build
% code .
```
### Laravelパッケージのインストール
```
% docker-compose exec php bash
% composer install
```
### .envファイルの作成
```
% cp .env.example .env
% exit
```
### .envファイルの修正

```diff
// 前略

DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
+ DB_HOST=mysql
DB_PORT=3306
- DB_DATABASE=laravel
- DB_USERNAME=root
- DB_PASSWORD=
+ DB_DATABASE=laravel_db
+ DB_USERNAME=laravel_user
+ DB_PASSWORD=laravel_pass

// 後略
```

### アプリケーションキー生成
```
% php artisan key:generate
```
### マイグレーション、シーディング
```
% php artisan migrate --seed
```
### シンボリックリンク
```
% php artisan storage:link
```
## テスト用ユーザー

以下のユーザーでログインして動作確認できます。
### 一般ユーザー
- メールアドレス：
- パスワード：password
### 管理者
- メールアドレス：admin@coachtech.com
- パスワード：password

## 使用技術（実行環境）
・PHP 8.2<br>
・Laravel 10.x<br>
・MySQL 8.0<br>
・Docker / Docker Compose<br>


## URL
・開発環境：http://localhost/<br>
・phpmyadmin：http://localhost:8080/<br>