<template>
  <IndexDefaultTemplate
    :insta-shops="instaShops"
    :areas="areas"
    :shops="recommendShops"
    :posts="state.posts"
    :news-list="newsList"
    :max-shop-count="shops.length"
  />
</template>

<script lang="ts">
import { defineComponent, reactive, useContext, useMeta, watchEffect } from '@nuxtjs/composition-api'
import { useNews } from '@/src/CompositonFunctions/news/UseNews'
import { useRecommendShop } from '@/src/CompositonFunctions/shops/UseRecommendShop'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { getShopListByInstaNumber } from '~/src/infra/firestore/Shop'
import { Post } from '~/lib'
import { getSelectionPostList } from '~/src/infra/backend/SelectionPost'

export default defineComponent({
  setup () {
    const state = reactive({
      posts: [] as Post[]
    })
    const { store, $axios, $fireStore } = useContext()

    const { recommendShops } = useRecommendShop($fireStore)
    const { newsList } = useNews()
    const { shops } = useShop(store, 500)
    const { areas } = useArea(store)

    watchEffect(async () => {
      const { records } = await getSelectionPostList($axios, 4)
      state.posts = records
    })

    useMeta({
      title: '宇都宮の新たなグルメサイト',
      meta: [
        { hid: 'og:type', property: 'og:type', content: 'website' }
      ]
    })

    return {
      areas,
      recommendShops,
      state,
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
