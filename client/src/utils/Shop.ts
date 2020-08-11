import { Shop, SHOP_TYPE } from '@/src/types/Shop'

/**
 * Shop型かどうか
 *
 * @param { any } v
 */
export const isShop = (v: any): v is Shop => {
  return typeof v === 'object' && v.type === SHOP_TYPE
}
