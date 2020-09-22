import { computed, SetupContext, watchEffect } from '@nuxtjs/composition-api'
import { Shop } from '@/lib'
import { ActionType } from '@/store/shops'

/**
 * お店一覧を取得する
 *
 * @param { SetupContext['root'] } context
 * @param { number } lazyTime 遅延ロードするときの ms
 */
export const useShop = ({ $store }: SetupContext['root'], lazyTime: number = 0) => {
  const shops = computed(() => {
    return $store.getters['shops/shops'] as Shop[]
  })

  watchEffect(async () => {
    if (lazyTime > 0) {
      setTimeout(async () => {
        await $store.dispatch(`shops/${ActionType.FETCH_SHOPS}`)
      }, lazyTime)
    } else {
      await $store.dispatch(`shops/${ActionType.FETCH_SHOPS}`)
    }
  })

  return {
    shops
  }
}
