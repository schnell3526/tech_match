# tech_match(暫定)

## データベース設計

![ER図](https://github.com/schnell3526/tech_match/blob/figure/%20db.png?raw=true)

## インストール手順

dockerfile をビルド

```bash
docker-compose build
docker-compose up -d
```

app コンテナでの作業

```bash
docker-compose exec app bash
chown www-data storage/ -R
(macの場合)
cp .env.example .env
(windowsの場合)
copy .env.example .env
composer install
php artisan key:generate
```

`http://127.0.0.1:8080/`にアクセスしページが表示されているかの確認
データベースの作成

```bash
docker-compose exec db bash
mysql -u root -p
create database tech_match
```
