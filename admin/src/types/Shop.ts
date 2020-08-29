// Shop: 店舗型
export type Shop = {
  type: ShopType,
  id: string,
  // 店舗名
  name?: string,
  // 店舗肩書き
  prefixName?: string,
  // 一言紹介
  description?: string,
  // 長文紹介
  intro?: string,
  // 住所
  address?: string,
  // 建物名
  buildingName?: string,
  // 郵便番号
  postal?: string|number,
  // 電話番号
  tel?: string|number,
  imageLink?: string,
  subImageLink?: string[],
  menuImageLink?: string[],
  facebookLink?: string,
  homepageLink?: string,
  instaLink?: string,
  lineLink?: string,
  twitterLink?: string,
  uberEatsLink?: string,
  youtubeLink?: string,
  // 優先度
  priority: number,
  // 価格帯
  priceRange?: string,
  // 公開設定
  public: boolean,
  // deprecated
  businessHour1?: string,
  // deprecated
  businessHour2?: string,
  businessStartHour1?: string|Date,
  businessEndHour1?: string|Date,
  businessLoHour1?: string|Date,
  businessStartHour2?: string|Date,
  businessEndHour2?: string|Date,
  businessLoHour2?: string|Date,
  parkingLot?: string,
  regularHoliday?: string,
  seat?: string,
  // テイクアウト可能かどうか
  canTakeout: boolean,
  instaShopLink?: string,
  instaNumber?: number,
  latitude?: number,
  longitude?: number,
  keywords: string[],
  dishes?: string[],
  timeZone?: string[],
  createdAt?: Date|Object,
  deletedAt?: Date|Object,
  updatedAt?: Date|Object
}

type ShopType = 'shop'

export const SHOP_TYPE = 'shop'

export const DEFAULT_IMAGE = '/no-image.png'

// ShopJa Shopの日本語名
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
