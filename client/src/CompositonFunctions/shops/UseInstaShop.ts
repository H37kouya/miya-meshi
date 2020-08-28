import { computed, SetupContext, watchEffect } from '@vue/composition-api'
import { Shop } from '@/lib'
import { ActionType } from '@/store/shops'

export const useInstaShop = ({ $store }: SetupContext['root']) => {
  const instaShops = computed(() => {
    return $store.getters['shops/instaShops'] as Shop[]
  })

  watchEffect(async () => {
    await $store.dispatch(`shops/${ActionType.FETCH_INSTA_SHOPS}`)
  })

  return {
    instaShops
  }
}
