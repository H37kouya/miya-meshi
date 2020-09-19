import { Area, Dish, Shop } from '@/lib'
import { Type } from '@/lib/enum'

/**
 * Shop型かどうか
 *
 * @param { any } v
 */
export const isShop = (v: any): v is Shop => typeof v === 'object' && v.type === Type.SHOP

/**
 * @param {Shop['address']} address
 */
export const computedShortShopAddress = (address: Shop['address']): Shop['address'] => {
  if (!address) {
    return undefined
  }

  if (address.startsWith('栃木県')) {
    return address.slice(3)
  }

  return address
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
export const getShopArea = (shop: Shop, areas: Area[]): Area|undefined => getShopAreaByAddress(shop.address, areas)

/**
 * Shopのエリアを取得する
 *
 * @param { Shop } shop
 * @param { Area[] } areas
 */
export const getShopAreaByAddress = (address: Shop['address'], areas: Area[]): Area|undefined => {
  if (!address) {
    return undefined
  }

  for (const area of areas) {
    for (const areaAddress of area.addresses) {
      if (address.includes(areaAddress)) {
        return area
      }
    }
  }

  return undefined
}
