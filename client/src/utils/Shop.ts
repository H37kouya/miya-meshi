import { Shop, SHOP_TYPE } from '@/src/types/Shop'
import { isString, kanji2num, zenkakuToHankaku } from '~/src/utils/String'
import { Area } from '@/src/types/Area'

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

  address = kanji2num(zenkakuToHankaku(address))

  if (address.startsWith('栃木県')) {
    return address
  }

  if (address.startsWith('宇都宮')) {
    return `栃木県${address}`
  }

  return address
}

export const formatShopPostal = (postal: Shop['postal']): Shop['postal'] => {
  if (!postal) {
    return undefined
  }

  const str = isString(postal) ? postal : String(postal)

  return zenkakuToHankaku(str)
}

/**
 * Shopのエリアを取得する
 *
 * @param { Shop } shop
 * @param { Area[] } areas
 */
export const getShopArea = (shop: Shop, areas: Area[]): Area|undefined => {
  if (!shop.address) {
    return undefined
  }

  for (const area of areas) {
    if (area.addresses.includes(shop.address)) {
      return area
    }
  }

  return undefined
}
