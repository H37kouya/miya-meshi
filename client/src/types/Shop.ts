// Shop: 店舗型
export type Shop = {
  type: ShopType,
  id: string,
  name?: string,
  description?: string,
  intro?: string,
  postal?: string|number,
  address?: string,
  buildingName?: string,
  tel?: string|number,
  imageLink?: string,
  subImageLink?: string[],
  facebookLink?: string,
  homepageLink?: string,
  instaLink?: string,
  lineLink?: string,
  twitterLink?: string,
  uberEatsLink?: string,
  youtubeLink?: string,
  priority: number,
  public: boolean,
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
  DESCRIPTION = 'お店紹介',
  INTRO = '一言紹介',
  IMAGE_LINK = '画像のリンク',
  SUB_IMAGE_LINK= 'サブ画像のリンク',
  INSTA_LINK = 'Instagram',
  TWITTER_LINK = 'Twitter',
  FACEBOOK_LINK = 'Facebook',
  LINE_LINK = 'Line',
  HOMEPAGE_LINK = 'ホームページ',
  UBER_EATS_LINK = 'UberEats',
  YOUTUBE_LINK = 'YouTube',
  PRIORITY = '優先度',
  PUBLIC = '公開設定',
  ADDRESS = '住所',
  BUILDING_NAME = '建物名',
  TEL = '電話番号',
  POSTAL = '郵便番号'
}

// ShopMaxStringSize Shop型のstringの最大文字数
export enum ShopMaxStringSize {
  NAME = 50,
  DESCRIPTION = 30,
  INTRO = 1000,
  ADDRESS = 100,
  BUILDING_NAME = 255,
}
