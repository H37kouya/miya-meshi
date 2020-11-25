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
import { defineComponent, useContext, useMeta } from '@nuxtjs/composition-api'
import { useNews } from '@/src/CompositonFunctions/news/UseNews'
import { useRecommendShop } from '@/src/CompositonFunctions/shops/UseRecommendShop'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { getShopListByInstaNumber } from '~/src/infra/firestore/Shop'

export default defineComponent({
  setup () {
    const { store, $fireStore } = useContext()

    const { recommendShops } = useRecommendShop($fireStore)
    const { newsList } = useNews()
    const { shops } = useShop(store, 500)
    const { areas } = useArea(store)

    useMeta({
      title: '宇都宮の新たなグルメサイト',
      meta: [
        { hid: 'og:type', property: 'og:type', content: 'website' }
      ]
    })

    return {
      areas,
      recommendShops,
      shops,
      newsList
    }
  },

  async asyncData({ $fireStore }) {
    const instaShops = await getShopListByInstaNumber($fireStore, 6)

    return { instaShops }
  },

  head: {}
})
</script>
