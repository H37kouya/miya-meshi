<template>
  <div>
    <MainText>
      お店から探す
    </MainText>

    <v-container>
      <v-breadcrumbs :items="breadcrumbs" class="pb-0 px-0 px-sm-6" />
    </v-container>

    <div class="u-light-grey-background pt-3">
      <SearchButtonGroup
        :btn-status="btnStatus"
        @input="(v) => btnStatus = v"
      />
    </div>

    <DefaultShopList :shops="displayShops" :max-item="shops.length" />
  </div>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { MetaInfo } from 'vue-meta'
import { Breadcrumb } from '@/lib'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'
import { useBtnStatus } from '@/src/CompositonFunctions/btnStatus/UseBtnStatus'
import { useFilterShopByBtnStatus } from '@/src/CompositonFunctions/btnStatus/UseFilterShopByBtnStatus'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: 'お店から探す', to: '/shops' },
] as Breadcrumb[]

export default defineComponent({
  setup (_, context: SetupContext) {
    const { btnStatus } = useBtnStatus(context)

    const { nowArea } = useArea(context.root)

    const { shops } = useShop(context.root)

    const { displayShops } = useFilterShopByBtnStatus(btnStatus, shops, nowArea)

    return {
      btnStatus,
      breadcrumbs,
      displayShops,
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
