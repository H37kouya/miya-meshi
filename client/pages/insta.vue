<template>
  <InstaIndexTemplate :areas="areas" :shops="instaShops" />
</template>

<script lang="ts">
import { defineComponent, useContext, useMeta } from '@nuxtjs/composition-api'
import { useInstaShop } from '@/src/CompositonFunctions/shops/UseInstaShop'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'

export default defineComponent({
  setup () {
    const { store } = useContext()

    const { areas } = useArea(store)
    const { instaShops } = useInstaShop(store)

    useMeta({
      title: 'インスタからのおすすめ'
    })

    return {
      areas,
      instaShops
    }
  },

  head: {}
})
</script>
