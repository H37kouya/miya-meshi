import { computed, SetupContext, watchEffect } from '@vue/composition-api'
import { Area } from '@/lib'
import { ActionType } from '@/store/areas'

export const useArea = ({ $store }: SetupContext['root']) => {
  // エリア一覧
  const areas = computed(() => {
    return $store.getters['areas/areas'] as Area[]
  })

  // 現在地から今いるエリアを算出
  const nowArea = computed(() => {
    return $store.getters['areas/nowArea'] as Area|undefined
  })

  watchEffect(async () => {
    await $store.dispatch(`areas/${ActionType.FETCH_AREAS}`)
  })

  return {
    areas,
    nowArea
  }
}
