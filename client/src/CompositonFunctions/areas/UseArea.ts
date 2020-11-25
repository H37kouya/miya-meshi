import { computed, watchEffect } from '@nuxtjs/composition-api'
import { Getters, ActionType } from '@/store/areas'
import { ActionType as GeolocationActionType } from '@/store/geolocation'
import { Context } from '@nuxt/types'

export const useArea = (store: Context['store']) => {
  // エリア一覧
  const areas = computed(() => {
    return store.getters['areas/areas'] as ReturnType<Getters['areas']>
  })

  // 現在地から今いるエリアを算出
  const nowArea = computed(() => {
    return store.getters['areas/nowArea'] as ReturnType<Getters['nowArea']>
  })

  const onUpdateNowArea = async () => {
    await store.dispatch(`geolocation/${GeolocationActionType.FETCH_LOCATION}`)
    store.dispatch(`areas/${ActionType.RE_COMPUTED_NOW_LOCATION}`)
  }

  watchEffect(async () => {
    if (process.client) {
      await store.dispatch(`geolocation/${GeolocationActionType.FETCH_LOCATION}`)
      await store.dispatch(`areas/${ActionType.FETCH_AREAS}`)
    }
  })

  return {
    areas,
    nowArea,
    onUpdateNowArea
  }
}
