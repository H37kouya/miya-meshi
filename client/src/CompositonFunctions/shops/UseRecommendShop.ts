import { reactive, SetupContext, toRefs, watchEffect } from '@vue/composition-api'
import { Shop } from '@/lib'
import { getShopList } from '@/src/infra/firestore/Shop'

export const useRecommendShop = ({ $fireStore }: SetupContext['root']) => {
  const state = reactive({
    recommendShops: [] as Shop[]
  })

  watchEffect(async () => {
    state.recommendShops = await getShopList($fireStore, 3)
  })

  return toRefs(state)
}
