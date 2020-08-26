import { reactive, SetupContext, toRefs, watchEffect } from '@vue/composition-api'
import { getMenuList } from 'miyameshi-lib/src/infra/firestore/Menu'
import { Menu } from 'miyameshi-lib'

export const useRecommendMenu = ({ $fireStore }: SetupContext['root']) => {
  const state = reactive({
    menus: [] as Menu[]
  })

  watchEffect(async () => {
    state.menus = await getMenuList($fireStore, 3)
  })

  return toRefs(state)
}
