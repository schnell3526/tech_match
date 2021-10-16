# tech_match(暫定)

## データベース設計

### 概念設計

![ER図](https://github.com/schnell3526/tech_match/blob/figure/db.png?raw=true)

### 物理設計

![物理設計](https://github.com/schnell3526/tech_match/blob/figure/db2.png?raw=true)

## 環境構築手順

環境のセットアップ

```bash
make init
```

[ここ](http://127.0.0.1:8080/)にアクセスして確認してみる。

コンテナの削除

```bash
make down
```

コンテナの作成

```bash
make up
```

コンテナの再起動

```bash
make restart
```

環境の全削除

```bash
make destoroy
```

データベース操作

```bash
make sql
```

その他コマンド

```bash
make help
```

