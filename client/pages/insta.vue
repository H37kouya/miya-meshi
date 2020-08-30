<template>
  <InstaIndexTemplate :shops="instaShops" />
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { MetaInfo } from 'vue-meta'
import { useInstaShop } from '@/src/CompositonFunctions/shops/UseInstaShop'

export default defineComponent({
  setup (_, context: SetupContext) {
    const { instaShops } = useInstaShop(context.root)

    return {
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

<style lang="scss" scoped>
.to-top-page {
  font-size: 0.8rem;
  text-decoration: none;

  &::before {
    content: '←';
  }
}
</style>
