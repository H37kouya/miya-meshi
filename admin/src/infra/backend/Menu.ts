import { NuxtAxiosInstance } from "@nuxtjs/axios"
import { Menu, Shop } from "~/lib"
import { Type } from "~/lib/enum"

export type PaginationPost = {
  hasNext: false
  hasPrevious: null
  nextCursor: null
  previousCursor: null
  records: Shop[]
}

/**
 * Shopを追加する
 *
 * @param { NuxtAxiosInstance } $axios
 * @param { Shop } shop
 */
export const createMenu = async (
  shopMenu: Menu,
  shopId: Shop['id'],
  apiToken: string,
  $axios: NuxtAxiosInstance
) => {
  await $axios.$post(`/api/admin/shop/${shopId}/menu`, shopMenu, {
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
export const editMenu = async (
  apiToken: string,
  shopMenu: Menu,
  shopID: Shop['id'],
  shopMenuID: Menu['id'],
  $axios: NuxtAxiosInstance
) => {
  await $axios.$put(`/api/admin/shop/${shopID}/menu/${shopMenuID}`, shopMenu, {
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
export const deleteMenu = async (
  apiToken: string,
  shopID: Shop['id'],
  shopMenuID: Menu['id'],
  $axios: NuxtAxiosInstance
) => {
  await $axios.$delete(`/api/admin/shop/${shopID}/menu/${shopMenuID}`, {
    headers: {
      'Authorization': `Bearer ${apiToken}`
    }
  })
}

/**
 * Shopの取得
 *
 * @param { NuxtAxiosInstance } $axios
 * @param { string } id
 */
export const getMenuByID = async (
  shopID: Shop['id'],
  shopMenuID: Menu['id'],
  apiToken: string,
  $axios: NuxtAxiosInstance
) => {
  type AxiosGetType = {
    data: Shop & {
      shopMenu: Menu
    }
  }
  const { data } = await $axios.$get<AxiosGetType>(`/api/admin/shop/${shopID}/menu/${shopMenuID}`, {
    headers: {
      'Authorization': `Bearer ${apiToken}`
    }
  })

  return {
    ...data,
    type: Type.SHOP
  } as Shop & {
    shopMenu: Menu
  }
}
