import {
  Type
} from '../enum/index'

// Menu メニュー型
export type Menu = {
  type: Type.MENU,
  id: string,
  shopId: string,
  name?: string,
  description?: string,
  intro?: string,
  image?: string,
  price?: number,
  release: boolean,
  isTaxIncluded?: boolean,
  canTakeout?: boolean,
  priority: number,
  dishes: string[],
  keywords: string[],
  periodOfTime?: string[],
  publishFrom: string|null
  publishTo: string|null
  createdAt?: Date|Object,
  updatedAt?: Date|Object,
  deletedAt?: Date|Object
}

export const DEFAULT_IMAGE = '/no-image.png'
