// Shop: 店舗型
export type Shop = {
  type: ShopType,
  id: string,
  prefixName?: string,
  name?: string,
  description?: string,
  intro?: string,
  postal?: string|number,
  address?: string,
  buildingName?: string,
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
  priority: number,
  priceRange?: string,
  public: boolean,
  businessHour1?: string,
  businessHour2?: string,
  parkingLot?: string,
  regularHoliday?: string,
  seat?: string,
  canTakeout: boolean,
  instaShopLink?: string,
  instaNumber?: number,
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
  INTRO = '店舗紹介文(長文可)',
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
  SEAT = '座席'
}

// ShopMaxStringSize Shop型のstringの最大文字数
export enum ShopMaxStringSize {
  NAME = 50,
  PREFIX_NAME = 30,
  DESCRIPTION = 30,
  INTRO = 1000,
  ADDRESS = 100,
  BUILDING_NAME = 255,
  BUSINESS_HOUR = 100,
  PARKING_LOT = 50,
  REGULAR_HOLIDAY = 50,
  SEAT = 50
}
