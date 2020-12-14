import { NuxtAxiosInstance } from "@nuxtjs/axios"
import { Menu, Shop } from "~/lib"
import { Type } from "~/lib/enum"

export type PaginationPost = {
  has_next: false
  has_previous: null
  next_cursor: null
  previous_cursor: null
  records: Shop[]
}

/**
 * Shopを追加する
 *
 * @param { NuxtAxiosInstance } $axios
 * @param { Shop } shop
 */
export const createShop = async (
  shop: Shop,
  apiToken: string,
  $axios: NuxtAxiosInstance
) => {
  await $axios.$post('/api/admin/shop', shop, {
    headers: {
      'Authorization': `Bearer ${apiToken}`
    }
  })
}

/**
 * Shopを追加する
 *
 * @param { NuxtAxiosInstance } $axios
 * @param { Shop } shop
 */
export const editShop = async (
  apiToken: string,
  shopID: Shop['id'],
  shop: Shop,
  $axios: NuxtAxiosInstance
) => {
  await $axios.$put(`/api/admin/shop/${shopID}`, shop, {
    headers: {
      'Authorization': `Bearer ${apiToken}`
    }
  })
}

/**
 * Shopを追加する
 *
 * @param { NuxtAxiosInstance } $axios
 * @param { Shop } shop
 */
export const deleteShop = async (
  apiToken: string,
  shopID: Shop['id'],
  $axios: NuxtAxiosInstance
) => {
  await $axios.$delete(`/api/admin/shop/${shopID}`, {
    headers: {
      'Authorization': `Bearer ${apiToken}`
    }
  })
}

/**
 * Shop一覧を取得
 *
 * @param { NuxtAxiosInstance } $axios
 */
export const getShopList = async (
  apiToken: string,
  $axios: NuxtAxiosInstance
) => {
  type AxiosGetType =  PaginationPost
  const { records } = await $axios.$get<AxiosGetType>(`/api/admin/shop`, {
    headers: {
      'Authorization': `Bearer ${apiToken}`
    },
    params: {
      limit: 1000
    }
  })

  return records.map((shop: Shop) => ({
    ...shop,
    type: Type.SHOP
  } as Shop))
}

/**
 * Shopの取得
 *
 * @param { NuxtAxiosInstance } $axios
 * @param { string } id
 */
export const getShopByID = async (
  id: string,
  apiToken: string,
  $axios: NuxtAxiosInstance
) => {
  type AxiosGetType = {
    data: Shop & {
      shop_menus: Menu[]
    }
  }
  const { data } = await $axios.$get<AxiosGetType>(`/api/admin/shop/${id}`, {
    headers: {
      'Authorization': `Bearer ${apiToken}`
    }
  })

  return {
    ...data,
    type: Type.SHOP
  } as Shop & {
    shop_menus: Menu[]
  }
}
