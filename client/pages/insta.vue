<template>
  <InstaIndexTemplate :areas="areas" :shops="instaShops" />
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { MetaInfo } from 'vue-meta'
import { useInstaShop } from '@/src/CompositonFunctions/shops/UseInstaShop'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'

export default defineComponent({
  setup (_, context: SetupContext) {
    const { areas } = useArea(context.root)
    const { instaShops } = useInstaShop(context.root)

    return {
      areas,
      instaShops
    }
  },

  head: (): MetaInfo => ({
    title: 'みやメシ図鑑',
    meta: [
      { property: 'og:type', content: 'article' }
    ]
  })
})
</script>
