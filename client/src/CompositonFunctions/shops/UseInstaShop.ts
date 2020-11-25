import { computed, watchEffect } from '@nuxtjs/composition-api'
import { Shop } from '@/lib'
import { ActionType } from '@/store/shops'
import { Context } from '@nuxt/types'

export const useInstaShop = (store: Context['store']) => {
  const instaShops = computed(() => store.getters['shops/instaShops'] as Shop[])

  watchEffect(async () => {
    await store.dispatch(`shops/${ActionType.FETCH_INSTA_SHOPS}`)
  })

  return {
    instaShops
  }
}
