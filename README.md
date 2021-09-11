
# A1_team

# インストール手順

docker-compose build
docker-compose up -d
docker-compose exec app bash

app コンテナの中には入って、
chown www-data storage/ -R
php artisan key:generate
http://127.0.0.1:8080/　でページが表示されているかの確認

exit
（データベースを作成）
docker-compose exec db bash
mysql -u root -p
create database tech_match

# tech_match(暫定)

## データベース設計

![ER図](https://github.com/schnell3526/tech_match/blob/figure/%20db.png?raw=true)

