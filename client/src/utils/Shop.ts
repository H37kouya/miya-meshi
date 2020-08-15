import { Shop, SHOP_TYPE } from '@/src/types/Shop'

/**
 * Shop型かどうか
 *
 * @param { any } v
 */
export const isShop = (v: any): v is Shop => {
  return typeof v === 'object' && v.type === SHOP_TYPE
}

/**
 * 住所をformatする
 *
 * @param {Shop['address']} address
 */
export const formatShopAddress = (address: Shop['address']): Shop['address'] => {
  if (!address) {
    return undefined
  }

  if (address.startsWith('栃木県')) {
    return address
  }

  if (address.startsWith('宇都宮')) {
    return `栃木県${address}`
  }

  return address
}
