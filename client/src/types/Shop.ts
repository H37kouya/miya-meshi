export type Shop = {
  type: ShopType,
  id: string,
  name?: string,
  description?: string,
  intro?: string,
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
  public?: boolean,
  createdAt?: Date,
  deletedAt?: Date,
  updatedAt?: Date
}

type ShopType = 'shop'

export const SHOP_TYPE = 'shop'

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
}
