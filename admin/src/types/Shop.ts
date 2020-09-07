export const DEFAULT_IMAGE = '/no-image.png'

// @deprecated
export enum ShopJa {
  ID = 'SHOP ID',
  NAME = '店名',
  PREFIX_NAME = '店舗肩書き',
  DESCRIPTION = '一言紹介',
  INTRO = 'ストーリー(店舗紹介文)',
  IMAGE_LINK = '画像のリンク',
  SUB_IMAGE_LINK = 'サブ画像のリンク',
  MENU_IMAGE_LINK = 'メニュー画像のリンク',
  INSTA_LINK = 'Instagram',
  TWITTER_LINK = 'Twitter',
  FACEBOOK_LINK = 'Facebook',
  LINE_LINK = 'Line',
  HOMEPAGE_LINK = 'ホームページ',
  UBER_EATS_LINK = 'UberEats',
  YOUTUBE_LINK = 'YouTube',
  INSTA_NUMBER = 'インスタで紹介している番号',
  INSTA_SHOP_LINK = 'インスタで紹介しているリンク',
  PRIORITY = '優先度',
  PUBLIC = '公開設定',
  ADDRESS = '住所',
  BUILDING_NAME = '建物名',
  TEL = '電話番号',
  POSTAL = '郵便番号',
  BUSINESS_HOUR = '営業時間',
  PARKING_LOT = '駐車場',
  PRICE_RANGE = '価格帯',
  REGULAR_HOLIDAY = '定休日',
  LATITUDE = '緯度',
  LONGITUDE = '経度',
  SEAT = '座席'
}

// ShopMaxStringSize Shop型のstringの最大文字数
// @deprecated
export enum ShopMaxStringSize {
  NAME = 50,
  PREFIX_NAME = 30,
  DESCRIPTION = 50,
  INTRO = 1000,
  ADDRESS = 100,
  BUILDING_NAME = 255,
  BUSINESS_HOUR = 100,
  PARKING_LOT = 50,
  REGULAR_HOLIDAY = 50,
  SEAT = 50
}
