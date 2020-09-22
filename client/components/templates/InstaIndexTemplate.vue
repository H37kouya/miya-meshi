<template>
  <div>
    <MainText id="miyameshi_pictures">
      インスタからのおすすめ
    </MainText>

    <div class="u-light-grey-background">
      <v-container class="py-0">
        <v-breadcrumbs :items="breadcrumbs" class="pb-0 px-0 px-sm-6" />
      </v-container>

      <v-container class="max-width-480">
        <v-combobox
          v-model="selectedNumber"
          :items="canSelectInstaNumber"
          label="番号で検索"
          hide-details
          multiple
        />
      </v-container>
    </div>

    <DefaultInstaShopList :shops="filterShops" :max-item="shops.length" />
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
    shops: {
      type: Array,
      default: () => []
    }
  },

  setup (props: Props, _) {
    const {
      canSelectInstaNumber,
      filterShops,
      selectedNumber
    } = useSearchInstaShopByInstaNumber<Props>(props)

    return {
      breadcrumbs,
      canSelectInstaNumber,
      filterShops,
      selectedNumber
    }
  }
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
