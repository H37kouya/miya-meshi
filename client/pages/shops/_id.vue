<template>
  <ShopidDefaultTemplate :shop="state.shop" :menus="state.menus" />
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { Menu } from '@/src/types/Menu'
import { getMenuListByShopID } from '@/src/infra/firestore/Menu'

type State = {
  shop: Shop,
  menus: Menu[]
}

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive<State>({
      shop: {} as Shop,
      menus: [] as Menu[]
    })

    watchEffect(async () => {
      const [shop, menus] = await Promise.all([
        getShopByID(context.root.$fireStore, context.root.$route.params.id),
        getMenuListByShopID(context.root.$fireStore, context.root.$route.params.id)
      ])
      state.shop = shop
      state.menus = menus
    })

    return {
      state
    }
  }
})
</script>
