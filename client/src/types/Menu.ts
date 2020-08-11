// Menu メニュー型
export type Menu = {
  type: MenuType,
  id: string,
  shopID: string,
  name?: string,
  description?: string,
  intro?: string,
  image?: string,
  price?: number,
  public: boolean,
  isTaxIncluded?: boolean,
  canTakeOut?: boolean,
  createdAt?: Date|Object,
  updatedAt?: Date|Object,
  deletedAt?: Date|Object
}

type MenuType = 'menu'

export const MENU_TYPE = 'menu' as MenuType

export enum MenuJa {
  NAME = 'メニュー名',
  DESCRIPTION = '一言紹介',
  INTRO = 'メニュー紹介',
  PRICE = '値段',
  IS_TAX_INCLUDED = '税込みかどうか',
  CAN_TAKEOUT = 'テイクアウトできるかどうか'
}

// MenuMaxStringSize Menu型のstringの最大文字数
export enum MenuMaxStringSize {
  NAME = 50,
  DESCRIPTION = 30,
  INTRO = 1000,
}
