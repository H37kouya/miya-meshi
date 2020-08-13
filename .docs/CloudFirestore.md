# Database Definetion

## Shop

> 店舗テーブル

| Column Name        | Type               | Explanation        |
| ------------------ | ------------------ | ------------------ |
| id                 | `String`           | Shop ID            |
| prefixName         | `String`           |                    |
| name               | `String`           |                    |
| description        | `String`           | Short Intro        |
| intro              | `String`           |                    |
| image              | `String`           | set Link           |
| subimage           | `Array<String>`    | set Links          |
| menuImage          | `String`           | Set Menu Image Link |
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
| businessHour1      | `DateTime`         | 営業時間1          |
| businessHour2      | `DateTime`         | 営業時間2          |
| parkingLot         | `String`           | 駐車場             |
| regularHoliday     | `String`           | 定休日             |
| seat               | `String`           | 座席             |
| canTakeOut         | `Boolean`          | テイクアウト可能か  |
| keywords           | `Array<String>`    |                    |
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

## Keyword

| Column Name     | Type            | Explanation        |
| --------------  | --------------- | ------------------ |
| id              | `String`        | Shop Menu ID       |
| name            | `String`        |                    |
| createdAt       | `DateTime`      | 作成日時           |
| updatedAt       | `DateTime`      | 更新日時           |

## User

> 認証時の役割

| Column Name     | Type            | Explanation   |
| --------------  | --------------- | ------------- |
| id              | `String`        | ID = User ID  |
| admin           | `Boolean`       | 管理者かどうか |
