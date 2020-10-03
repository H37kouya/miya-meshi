<template>
  <IndexDefaultTemplate
    :insta-shops="instaShops"
    :areas="areas"
    :shops="recommendShops"
    :news-list="newsList"
    :max-shop-count="shops.length"
  />
</template>

<script lang="ts">
import { defineComponent, SetupContext, useMeta } from '@nuxtjs/composition-api'
import { useInstaShopForTopPage } from '@/src/CompositonFunctions/shops/UseInstaShopForTopPage'
import { useNews } from '@/src/CompositonFunctions/news/UseNews'
import { useRecommendShop } from '@/src/CompositonFunctions/shops/UseRecommendShop'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'

export default defineComponent({
  setup (_, context: SetupContext) {
    const { instaShops } = useInstaShopForTopPage(context.root)
    const { recommendShops } = useRecommendShop(context.root)
    const { newsList } = useNews()
    const { shops } = useShop(context.root, 2000)
    const { areas } = useArea(context.root)

    useMeta({
      title: 'みやメシ応援隊',
      titleTemplate: undefined,
      meta: [
        { hid: 'og:type', property: 'og:type', content: 'website' }
      ]
    })

    return {
      areas,
      instaShops,
      recommendShops,
      shops,
      newsList
    }
  },

  head: {}
})
</script>
