# Database Definetion

## Shop

> 店舗テーブル

| Column Name        | Type               | Explanation        |
| ------------------ | ------------------ | ------------------ |
| id                 | `String`           | Shop ID            |
| prefix_name        | `String`           |                    |
| name               | `String`           |                    |
| description        | `String`           | Short Intro        |
| intro              | `String`           |                    |
| image              | `String`           | set Link           |
| subimage           | `Array<String>`    | set Links          |
| postal             | `String(xxx-xxxx)` | 郵便番号           |
| address            | `String`           | 住所               |
| buildingName       | `String`           | 建物名             |
| tel                | `String`           | 電話番号           |
| instaLink          | `String`           | Instagram          |
| twitterLink        | `String`           | Twitter            |
| facebookLink       | `String`           | Facebook           |
| lineLink           | `String`           | Line               |
| homepageLink       | `String`           | Home Page          |
| ubereatsLink       | `String`           | Uber Eats          |
| priority           | `Number`           | 優先度             |
| public             | `Boolean`          | 公開設定           |
| businessHourStart1 | `DateTime`         | 営業開始時間       |
| businessHourEnd1   | `DateTime`         | 営業終了時間       |
| businessHourStart2 | `DateTime`         | 営業開始時間       |
| businessHourEnd2   | `DateTime`         | 営業終了時間       |
| canTakeOut         | `Boolean`          | テイクアウト可能か  |
| createdAt          | `DateTime`         | 作成日時           |
| deletedAt          | `DateTime`         | 削除日時           |
| updatedAt          | `DateTime`         | 更新日時           |

## Shop Menu

> 店舗メニューテーブル

| Column Name     | Type            | Explanation        |
| --------------  | --------------- | ------------------ |
| id              | `String`        | Shop Menu ID       |
| shopID          | `String`        | Shop ID            |
| name            | `String`        |                    |
| description     | `String`        | Short Intro        |
| intro           | `String`        |                    |
| image           | `String`        | set Link           |
| price           | `Number`        | 値段               |
| public          | `Boolean`       | 公開設定            |
| isTaxOIncluded  | `Boolean`       | 税込みかどうか      |
| canTakeOut      | `Boolean`       | テイクアウト可能か  |
| createdAt       | `DateTime`      | 作成日時           |
| deletedAt       | `DateTime`      | 削除日時           |
| updatedAt       | `DateTime`      | 更新日時           |

## User

> 認証時の役割

| Column Name     | Type            | Explanation   |
| --------------  | --------------- | ------------- |
| id              | `String`        | ID = User ID  |
| admin           | `Boolean`       | 管理者かどうか |
