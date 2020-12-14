import {
  Type
} from '../enum/index'

// Menu メニュー型
export type Menu = {
  type: Type.MENU,
  id: string,
  shop_id: string,
  name?: string,
  description?: string,
  intro?: string,
  image?: string,
  price?: number,
  release: boolean,
  is_tax_included?: boolean,
  can_takeout?: boolean,
  priority: number,
  dishes: string[],
  keywords: string[],
  period_of_time?: string[],
  created_at?: Date|Object,
  updated_at?: Date|Object,
  deleted_at?: Date|Object
}

export const DEFAULT_IMAGE = '/no-image.png'
