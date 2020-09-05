# 環境変数について

## 概要

Prefixに`FIREBASE_`とつくものは、[Firebase](https://firebase.google.com/?hl=ja) に関するものである。

## メイン側

| Key Name                     | Types   | Remarks |
| ---------------------------- | ------- | ------- |
| FIREBASE_API_KEY             | string  |         |
| FIREBASE_AUTH_DOMAIN         | string  |         |
| FIREBASE_DATABASE_URL        | string  |         |
| FIREBASE_PROJECT_ID          | string  |         |
| FIREBASE_STORAGE_BUCKET      | string  |         |
| FIREBASE_MESSAGING_SENDER_ID | string  |         |
| FIREBASE_APP_ID              | string  |         |
| FIREBASE_MEASUREMENT_ID      | string  |         |
| TEST_ENV                     | boolean | TRUE時は、ローカル環境、テスト環境であることを示す。 |

## 管理者側

| Key Name                     | Types   | Remarks |
| ---------------------------- | ------- | ------- |
| FIREBASE_API_KEY             | string  |         |
| FIREBASE_AUTH_DOMAIN         | string  |         |
| FIREBASE_DATABASE_URL        | string  |         |
| FIREBASE_PROJECT_ID          | string  |         |
| FIREBASE_STORAGE_BUCKET      | string  |         |
| FIREBASE_MESSAGING_SENDER_ID | string  |         |
| FIREBASE_APP_ID              | string  |         |
| FIREBASE_MEASUREMENT_ID      | string  |         |
| POSTAL_API_KEY               | string  | PostcodeJP APIで発行 https://postcode-jp.com/ |
| TEST_ENV                     | boolean | TRUE時は、ローカル環境、テスト環境であることを示す。 |
