import { computed, watchEffect } from '@nuxtjs/composition-api'
import { Getters, ActionType } from '@/store/dishes'
import { Context } from '@nuxt/types'

export const useDish = (store: Context['store']) => {
  // 料理一覧
  const dishes = computed(() => store.getters['dishes/dishes'] as ReturnType<Getters['dishes']>)

  watchEffect(async () => {
    await store.dispatch(`dishes/${ActionType.FETCH_DISHES}`)
  })

  return {
    dishes
  }
}
