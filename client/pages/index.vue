<template>
  <IndexDefaultTemplate :insta-shops="instaShops" :menus="state.menus" :news-list="newsList" />
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import NewsList from '@/assets/json/NewsList.json'
import { getMenuList } from '@/src/infra/firestore/Menu'
import { Menu } from '@/src/types/Menu'
import { News } from '@/src/types/News'
import { useInstaShopForTopPage } from '~/src/CompositonFunctions/shops/UseInstaShopForTopPage'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      menus: [] as Menu[]
    })

    const { instaShops } = useInstaShopForTopPage(context.root)

    watchEffect(async () => {
      const [menus] = await Promise.all([
        getMenuList(context.root.$fireStore, 3)
      ])
      state.menus = menus
    })

    const newsList = computed(() => NewsList.data as News[])

    return {
      state,
      instaShops,
      newsList
    }
  }
})
</script>
