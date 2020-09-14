<template>
  <IndexDefaultTemplate :insta-shops="instaShops" :shops="shops" :news-list="newsList" :max-shop-count="96" />
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { useInstaShopForTopPage } from '@/src/CompositonFunctions/shops/UseInstaShopForTopPage'
import { useNews } from '@/src/CompositonFunctions/news/UseNews'
import { useRecommendShop } from '@/src/CompositonFunctions/shops/useRecommendShop'

export default defineComponent({
  setup (_, context: SetupContext) {
    const { instaShops } = useInstaShopForTopPage(context.root)
    const { shops } = useRecommendShop(context.root)
    const { newsList } = useNews()

    return {
      instaShops,
      shops,
      newsList
    }
  }
})
</script>
