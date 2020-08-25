import {
  Type
} from '../enum/index'

// Menu メニュー型
export type Menu = {
  type: Type.MENU,
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
  priority: number,
  dishes: string[],
  keywords: string[],
  timeZone?: string[],
  createdAt?: Date|Object,
  updatedAt?: Date|Object,
  deletedAt?: Date|Object
}

export const DEFAULT_IMAGE = '/no-image.png'
