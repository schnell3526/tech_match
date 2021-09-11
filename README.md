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
