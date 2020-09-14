import { Area, Dish, Shop } from '@/lib'
import { Type } from '@/lib/enum'
import { kanji2num, isString, zenkakuToHankaku } from './String'

/**
 * Shop型かどうか
 *
 * @param { any } v
 */
export const isShop = (v: any): v is Shop => typeof v === 'object' && v.type === Type.SHOP

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
   * Areaを用いて、Shopをfilterする
   */
export const filterShopsByAreas = (shops: Shop[], areas: Area[]) => {
  const addresses = areas.reduce((pv, area) => {
    return [...pv, ...area.addresses]
  }, [] as string[])

  return shops.filter((shop: Shop) => {
    if (!shop.address) {
      return false
    }

    for (const address of addresses) {
      if (shop.address.includes(address)) {
        return true
      }
    }

    return false
  })
}

export const filterShopsByDishes = (shops: Shop[], dishes: Dish[]) => {
  return shops.filter((shop: Shop) => {
    if (!shop.dishes) {
      return false
    }

    for (const dish of dishes) {
      if (shop.dishes.includes(dish.id)) {
        return true
      }
    }

    return false
  })
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
