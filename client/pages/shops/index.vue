<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <MainText>
      お店から探す
    </MainText>

    <div>
      <SearchAreaAndKyewordField
        :area="nowArea"
      />
    </div>

    <DefaultShopList :areas="areas" :shops="shops" :max-item="shops.length" />
  </div>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { MetaInfo } from 'vue-meta'
import { Breadcrumb } from '@/lib'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: 'お店から探す', to: '/shops' },
] as Breadcrumb[]

export default defineComponent({
  setup (_, context: SetupContext) {
    const { areas, nowArea } = useArea(context.root)

    const { shops } = useShop(context.root)

    return {
      areas,
      breadcrumbs,
      nowArea,
      shops
    }
  },

  head: (): MetaInfo => ({
    title: 'お店から探す',
    meta: [
      { property: 'og:type', content: 'article' }
    ]
  })
})
</script>
