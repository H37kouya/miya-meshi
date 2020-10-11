<template>
  <InstaIndexTemplate :areas="areas" :shops="instaShops" />
</template>

<script lang="ts">
import { defineComponent, SetupContext, useMeta } from '@nuxtjs/composition-api'
import { useInstaShop } from '@/src/CompositonFunctions/shops/UseInstaShop'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'

export default defineComponent({
  setup (_, context: SetupContext) {
    const { areas } = useArea(context.root)
    const { instaShops } = useInstaShop(context.root)

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
