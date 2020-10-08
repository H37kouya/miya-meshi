import { Area, Dish, Shop } from '@/lib'
import { Type } from '@/lib/enum'

/**
 * Shop型かどうか
 *
 * @param { any } v
 */
export const isShop = (v: any): v is Shop => typeof v === 'object' && v.type === Type.SHOP

/**
 * 表示用に短くした住所を取得
 *
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

  const replacedAddresses = addresses.map((address: string) => address.replace('丁目', ''))

  return shops.filter((shop: Shop) => {
    if (!shop.address) {
      return false
    }

    for (const address of replacedAddresses) {
      if (shop.address.includes(address)) {
        return true
      }
    }

    return false
  })
}

/**
 * Dish IDによって、shopsをフィルターする
 *
 * @param { Shop[] } shops
 * @param { Dish['id'][] } dishIDs
 */
export const filterShopsByDishIDs = (shops: Shop[], dishIDs: Dish['id'][]) => {
  return shops.filter((shop: Shop) => {
    if (!shop.dishes) {
      return false
    }

    for (const id of dishIDs) {
      if (shop.dishes.includes(id)) {
        return true
      }
    }

    return false
  })
}

/**
 * Dishによって、shopsをフィルターする
 *
 * @param { Shop[] } shops
 * @param { Dish[] } dishes
 */
export const filterShopsByDishes = (shops: Shop[], dishes: Dish[]) => {
  return filterShopsByDishIDs(shops, dishes.map((dish: Dish) => dish.id))
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
 * @param { Shop['address'] } address
 * @param { Area[] } areas
 */
export const getShopAreaByAddress = (address: Shop['address'], areas: Area[]): Area|undefined => {
  if (!address) {
    return undefined
  }

  for (const area of areas) {
    for (const areaAddress of area.addresses) {
      const _areaAddress = areaAddress.replace('丁目', '')
      if (address.includes(_areaAddress)) {
        return area
      }
    }
  }

  return undefined
}
