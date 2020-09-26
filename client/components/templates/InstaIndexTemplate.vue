<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container mb-0">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <MainText id="miyameshi_pictures" class="text-md-center">
      インスタからのおすすめ
    </MainText>

    <!-- <div class="u-light-grey-background">
      <v-container class="max-width-480">
        <v-combobox
          v-model="selectedNumber"
          :items="canSelectInstaNumber"
          label="番号で検索"
          hide-details
          multiple
        />
      </v-container>
    </div> -->

    <DefaultInstaShopList :areas="areas" :shops="filterShops" :max-item="shops.length" />
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'
import { Breadcrumb, Shop } from '@/lib'
import { useSearchInstaShopByInstaNumber } from '@/src/CompositonFunctions/shops/UseSearchInstaShopByInstaNumber'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: 'インスタからのおすすめ', to: '/insta' }
] as Breadcrumb[]

type Props = {
  shops: Shop[]
}

export default defineComponent({
  props: {
    areas: {
      type: Array,
      default: () => []
    },

    shops: {
      type: Array,
      default: () => []
    }
  },

  setup (props: Props, _) {
    const {
      filterShops
    } = useSearchInstaShopByInstaNumber<Props>(props)

    return {
      breadcrumbs,
      filterShops
    }
  }
})
</script>
