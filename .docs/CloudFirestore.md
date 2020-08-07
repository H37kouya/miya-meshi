# Database Definetion

## Shop

> 店舗テーブル

| Column Name    | Type               | Explanation   |
| -------------- | ------------------ | ------------- |
| id             | `String`           | Shop ID       |
| prefix_name    | `String`           |               |
| name           | `String`           |               |
| description    | `String`           | Short Intro   |
| intro          | `String`           |               |
| image          | `String`           | set Link      |
| subimage       | `Array<String>`    | set Links     |
| postal         | `String(xxx-xxxx)` | 郵便番号       |
| address        | `String`           | 住所          |
| buildingName   | `String`           | 建物名        |
| tel            | `String`           | 電話番号      |
| instaLink      | `String`           | Instagram     |
| twitterLink    | `String`           | Twitter       |
| facebookLink   | `String`           | Facebook      |
| lineLink       | `String`           | Line          |
| homepageLink   | `String`           | Home Page     |
| ubereatsLink   | `String`           | Uber Eats     |
| priority       | `Number`           | 優先度        |
| public         | `Boolean`          | 公開設定      |
| createdAt      | `DateTime`         |               |
| deletedAt      | `DateTime`         |               |
| updatedAt      | `DateTime`         |               |

## Shop Menu

> 店舗メニューテーブル

| Column Name     | Type            | Explanation   |
| --------------  | --------------- | ------------- |
| id              | `String`        | Shop Menu ID  |
| shopID          | `String`        | Shop ID       |
| name            | `String`        |               |
| description     | `String`        | Short Intro   |
| intro           | `String`        |               |
| image           | `String`        | set Link      |
| price           | `Number`        |               |
| isTaxOIncluded  | `Boolean`       | 税込みかどうか |
| createdAt       | `DateTime`      |               |
| deletedAt       | `DateTime`      |               |
| updatedAt       | `DateTime`      |               |
