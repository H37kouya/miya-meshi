declare const phoneNominality: unique symbol
// 電話番号型
export type PhoneNumber = string & { [phoneNominality]: never }
