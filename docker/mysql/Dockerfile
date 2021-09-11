FROM mysql/mysql-server:8.0


ENV MYSQL_DATABASE=tech_match \
  MYSQL_USER=root \
  MYSQL_PASSWORD=root \
  MYSQL_ROOT_PASSWORD=root \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/my.cnf
RUN chmod 644 /etc/my.cnf

