<template>
  <div>
    <MainText id="miyameshi_pictures">
      インスタからのおすすめ
    </MainText>

    <div class="u-light-grey-background">
      <v-container class="max-width-480">
        <p class="mb-0">
          <nuxt-link to="/" class="to-top-page">
            トップページへ
          </nuxt-link>
        </p>

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
import { defineComponent } from '@vue/composition-api'
import { Shop } from '@/lib'
import { useSearchInstaShopByInstaNumber } from '@/src/CompositonFunctions/shops/UseSearchInstaShopByInstaNumber'

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
      canSelectInstaNumber,
      filterShops,
      selectedNumber
    }
  }
})
</script>
