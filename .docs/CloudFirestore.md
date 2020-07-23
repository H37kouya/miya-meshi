# Database Definetion

## Shop

| Column Name    | Type            | Explanation   |
| -------------- | --------------- | ------------- |
| id             | `String`        | Shop ID       |
| prefix_name    | `String`        |               |
| name           | `String`        |               |
| description    | `String`        | Short Intro   |
| intro          | `String`        |               |
| image          | `String`        | set Link      |
| subimage       | `Array<String>` | set Links     |
| insta_link     | `String`        | Instagram     |
| twitter_link   | `String`        | Twitter       |
| facebook_link  | `String`        | Facebook      |
| line_link      | `String`        | Line          |
| homepage_link  | `String`        | Home Page     |
| ubereats_link  | `String`        | Uber Eats     |
| priority       | `Number`        |               |
| public         | `Boolean`       | Relase Status |
| created_at     | `DateTime`      |               |
| deleted_at     | `DateTime`      |               |
| updated_at     | `DateTime`      |               |

## Shop Menu

| Column Name     | Type            | Explanation  |
| --------------  | --------------- | ------------ |
| id              | `String`        | Shop Menu ID |
| shop_id         | `String`        | Shop ID      |
| name            | `String`        |              |
| description     | `String`        | Short Intro  |
| intro           | `String`        |              |
| image           | `String`        | set Link     |
| price           | `Number`        |              |
| is_tax_included | `Boolean`       |              |
