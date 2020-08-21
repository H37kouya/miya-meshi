<template>
  <IndexDefaultTemplate :insta-shops="instaShops" :menus="menus" :news-list="newsList" />
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { useInstaShopForTopPage } from '@/src/CompositonFunctions/shops/UseInstaShopForTopPage'
import { useNews } from '@/src/CompositonFunctions/news/UseNews'
import { useMenu } from '@/src/CompositonFunctions/menus/UseMenu'

export default defineComponent({
  setup (_, context: SetupContext) {
    const { instaShops } = useInstaShopForTopPage(context.root)
    const { menus } = useMenu(context.root)
    const { newsList } = useNews()

    return {
      instaShops,
      menus,
      newsList
    }
  }
})
</script>
