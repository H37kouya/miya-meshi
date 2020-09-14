import { computed, SetupContext, watchEffect } from '@vue/composition-api'
import { Getters, ActionType } from '@/store/dishes'

export const useDish = ({ $store }: SetupContext['root']) => {
  // 料理一覧
  const dishes = computed(() => {
    return $store.getters['dishes/dishes'] as ReturnType<Getters['dishes']>
  })

  watchEffect(async () => {
    await $store.dispatch(`dishes/${ActionType.FETCH_DISHES}`)
  })

  return {
    dishes
  }
}
