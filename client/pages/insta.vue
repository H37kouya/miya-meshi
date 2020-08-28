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
          v-model="state.selectedNumber"
          :items="selectItems"
          label="番号で検索"
          hide-details
          multiple
        />
      </v-container>
    </div>

    <DefaultInstaShopList :shops="filterShops" :max-item="instaShops.length" />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext } from '@vue/composition-api'
import { Shop } from '@/lib'
import { MetaInfo } from 'vue-meta'
import { useInstaShop } from '@/src/CompositonFunctions/shops/UseInstaShop'

type State = {
  selectedNumber: number[]
}
export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive<State>({
      selectedNumber: [] as number[]
    })

    const { instaShops } = useInstaShop(context.root)

    const selectItems = computed(() => {
      return instaShops.value.map((shop: Shop) => shop.instaNumber)
    })

    const filterShops = computed(() => {
      if (state.selectedNumber.length === 0) {
        return instaShops.value
      }

      const selected = state.selectedNumber.map(v => Number(v))

      return instaShops.value.filter((shop: Shop) => {
        if (!shop.instaNumber) {
          return false
        }

        return selected.includes(shop.instaNumber)
      })
    })

    return {
      instaShops,
      selectItems,
      filterShops,
      state
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
