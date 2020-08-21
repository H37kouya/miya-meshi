<template>
  <IndexDefaultTemplate :insta-shops="state.instaShops" :menus="state.menus" :news-list="newsList" />
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import NewsList from '@/assets/json/NewsList.json'
import { getMenuList } from '@/src/infra/firestore/Menu'
import { Menu } from '@/src/types/Menu'
import { News } from '@/src/types/News'
import { Shop } from '@/src/types/Shop'
import { getShopListByInstaNumber } from '@/src/infra/firestore/Shop'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      menus: [] as Menu[],
      instaShops: [] as Shop[]
    })

    watchEffect(async () => {
      const [shops, menus] = await Promise.all([
        getShopListByInstaNumber(context.root.$fireStore, 6),
        getMenuList(context.root.$fireStore, 3)
      ])
      state.instaShops = shops
      state.menus = menus
    })

    const newsList = computed(() => NewsList.data as News[])

    return {
      state,
      newsList
    }
  }
})
</script>
