import { computed, SetupContext, watchEffect } from '@vue/composition-api'
import { Getters, ActionType } from '@/store/areas'
import { ActionType as GeolocationActionType } from '@/store/geolocation'

export const useArea = ({ $store }: SetupContext['root']) => {
  // エリア一覧
  const areas = computed(() => {
    return $store.getters['areas/areas'] as ReturnType<Getters['areas']>
  })

  // 現在地から今いるエリアを算出
  const nowArea = computed(() => {
    return $store.getters['areas/nowArea'] as ReturnType<Getters['nowArea']>
  })

  watchEffect(async () => {
    if (process.client) {
      await $store.dispatch(`geolocation/${GeolocationActionType.FETCH_LOCATION}`)
      await $store.dispatch(`areas/${ActionType.FETCH_AREAS}`)
    }
  })

  return {
    areas,
    nowArea
  }
}
