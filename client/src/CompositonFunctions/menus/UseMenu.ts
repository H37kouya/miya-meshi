import { reactive, SetupContext, toRefs, watchEffect } from '@nuxtjs/composition-api'
import { Menu } from '@/lib'
import { getMenuList } from '@/src/infra/firestore/Menu'

type State = {
  menus: Menu[]
}

export const useMenu = ({ $fireStore }: SetupContext['root']) => {
  const state = reactive<State>({
    menus: [] as Menu[]
  })

  watchEffect(async () => {
    state.menus = await getMenuList($fireStore)
  })

  return {
    ...toRefs(state)
  }
}
