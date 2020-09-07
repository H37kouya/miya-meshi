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
| priority           | `Number`           | 優先度(表示順)      |
| public             | `Boolean`          | 公開設定           |
| businessStartHour1 | `DateTime`         | 営業時間1          |
| businessEndHour1   | `DateTime`         | 営業時間1          |
| businessLOHour1    | `DateTime`         | 営業時間1          |
| businessStartHour2 | `DateTime`         | 営業時間1          |
| businessEndHour2   | `DateTime`         | 営業時間2          |
| businessLoHour2    | `DateTime`         | 営業時間2          |
| parkingLot         | `String`           | 駐車場             |
| regularHoliday     | `String`           | 定休日             |
| seat               | `String`           | 座席             |
| canTakeOut         | `Boolean`          | テイクアウト可能か  |
| priceRange         | `String`           | 価格帯             |
| dishes             | `Array<String>`    | 料理一覧            |
| keywords           | `Array<String>`    | キーワード一覧      |
| instaNumber        | `Number`           | インスタの番号      |
| instaShopLink      | `String`           | インスタの店舗のリンク |
| displayMode        | `String`           | SIMPLE: 簡易掲載モード、 DEFAULT: ノーマルモード |
| createdAt          | `DateTime`         | 作成日時           |
| deletedAt          | `DateTime`         | 削除日時           |
| updatedAt          | `DateTime`         | 更新日時           |

## Menus

> 店舗メニューテーブル

| Column Name     | Type            | Explanation        |
| --------------  | --------------- | ------------------ |
| id              | `String`        | Menu ID            |
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
| priority        | `Number`        | 優先度(表示順)      |
| createdAt       | `DateTime`      | 作成日時           |
| updatedAt       | `DateTime`      | 更新日時           |

## User

> 認証時の役割

| Column Name     | Type            | Explanation   |
| --------------  | --------------- | ------------- |
| id              | `String`        | ID = User ID  |
| admin           | `Boolean`       | 管理者かどうか |

## PriceRange

> 価格帯

| Column Name     | Type            | Explanation   |
| --------------  | --------------- | ------------- |
| id              | `String`        | PriceRange ID |
| name            | `String`        |               |
| priority        | `Number`        | 優先度(表示順) |
| createdAt       | `DateTime`      | 作成日時      |
| updatedAt       | `DateTime`      | 更新日時      |

## Dishes

> 料理一覧

| Column Name     | Type            | Explanation   |
| --------------  | --------------- | ------------- |
| id              | `String`        | PriceRange ID |
| name            | `String`        |               |
| priority        | `Number`        | 優先度(表示順) |
| createdAt       | `DateTime`      | 作成日時       |
| updatedAt       | `DateTime`      | 更新日時       |
