# blogApp
## データ定義

blog table
| data_name | type      | length | default | auto_increment |
|:--------- |:--------- |:------ | ------- |:-------------- |
| id        | INT       |        |         | ture           |
| title     | VARCHAR   | 191    |         |                |
| content   | TEXT      |        |         |                |
| category  | INT       |        |         |                |
| post_at   | TIMESTAMP |        |         |                |
| status    | INT       |        | 1       |                |