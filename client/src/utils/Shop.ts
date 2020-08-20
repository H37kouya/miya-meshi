import { Shop, SHOP_TYPE } from '@/src/types/Shop'
import { kanji2num, zenkakuToHankaku } from '~/src/utils/String'

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

  return zenkakuToHankaku(postal)
}
