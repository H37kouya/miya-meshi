import { reactive, toRefs, watchEffect } from '@nuxtjs/composition-api'
import { Shop } from '@/lib'
import { getShopList } from '@/src/infra/firestore/Shop'

type State = {
  recommendShops: Shop[]
}
export const useRecommendShop = ($fireStore: firebase.firestore.Firestore) => {
  const state = reactive<State>({
    recommendShops: [] as Shop[]
  })

  watchEffect(async () => {
    state.recommendShops = await getShopList($fireStore, 4)
  })

  return {
    ...toRefs(state)
  }
}
