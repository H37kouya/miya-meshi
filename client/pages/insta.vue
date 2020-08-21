<template>
  <div>
    <DefaultMainText>
      みやメシ図鑑
    </DefaultMainText>

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

    <DefaultInstaShopList :shops="filterShops" :max-item="state.shops.length" />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { getShopListByInstaNumber } from '@/src/infra/firestore/Shop'
import { MetaInfo } from 'vue-meta'

type State = {
  shops: Shop[],
  selectedNumber: number[]
}
export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive<State>({
      shops: [] as Shop[],
      selectedNumber: [] as number[]
    })

    watchEffect(async () => {
      state.shops = await getShopListByInstaNumber(context.root.$fireStore, 0)
    })

    const selectItems = computed(() => {
      return state.shops.map((shop: Shop) => shop.instaNumber)
    })

    const filterShops = computed(() => {
      if (state.selectedNumber.length === 0) {
        return state.shops
      }

      const selected = state.selectedNumber.map(v => Number(v))

      return state.shops.filter((shop: Shop) => {
        if (!shop.instaNumber) {
          return false
        }

        return selected.includes(shop.instaNumber)
      })
    })

    return {
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
