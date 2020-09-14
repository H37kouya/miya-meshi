<template>
  <IndexDefaultTemplate
    :insta-shops="instaShops"
    :shops="recommendShops"
    :news-list="newsList"
    :max-shop-count="shops.length"
  />
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { useInstaShopForTopPage } from '@/src/CompositonFunctions/shops/UseInstaShopForTopPage'
import { useNews } from '@/src/CompositonFunctions/news/UseNews'
import { useRecommendShop } from '@/src/CompositonFunctions/shops/UseRecommendShop'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'

export default defineComponent({
  setup (_, context: SetupContext) {
    const { instaShops } = useInstaShopForTopPage(context.root)
    const { recommendShops } = useRecommendShop(context.root)
    const { newsList } = useNews()
    const { shops } = useShop(context.root, 2000)

    return {
      instaShops,
      recommendShops,
      shops,
      newsList
    }
  }
})
</script>
