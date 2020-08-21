<template>
  <IndexDefaultTemplate :insta-shops="instaShops" :menus="menus" :news-list="newsList" />
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { useInstaShopForTopPage } from '@/src/CompositonFunctions/shops/UseInstaShopForTopPage'
import { useNews } from '@/src/CompositonFunctions/news/UseNews'
import { useRecommendMenu } from '@/src/CompositonFunctions/menus/UseRecommendMenu'

export default defineComponent({
  setup (_, context: SetupContext) {
    const { instaShops } = useInstaShopForTopPage(context.root)
    const { menus } = useRecommendMenu(context.root)
    const { newsList } = useNews()

    return {
      instaShops,
      menus,
      newsList
    }
  }
})
</script>
