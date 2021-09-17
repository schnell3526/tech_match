# tech_match(暫定)

## データベース設計

![ER図](https://github.com/schnell3526/tech_match/blob/figure/%20db.png?raw=true)

## インストール手順

dockerfileをビルド

```bash
docker-compose build
docker-compose up -d
```

appコンテナでの作業

```bash
docker-compose exec app bash
chown www-data storage/ -R
php artisan key:generate
```

`http://127.0.0.1:8080/`にアクセスしページが表示されているかの確認
データベースの作成

```bash
docker-compose exec db bash
mysql -u root -p
create database tech_match
```
