<template>
  <div>
    <DefaultMainText id="result_detail_search">
      詳細検索結果
    </DefaultMainText>

    <div class="u-light-grey-background pt-3">
      <v-container>
        <p class="mb-0">
          <nuxt-link to="/keywords/detail" class="to-detail-search">
            詳細検索に戻る
          </nuxt-link>
        </p>
      </v-container>

      <SearchButtonGroup
        :btn-status="state.btnStatus"
        @input="(v) => state.btnStatus = v"
      />
    </div>

    <DefaultShopList :shops="filterShops" :max-item="shops.length" />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { BtnStatus } from '@/components/molecules/button_group/SearchButtonGroup.vue'
import { MetaInfo } from 'vue-meta'
import { filterShopsByAreas } from '@/src/utils/Shop'
import { filterAreasByID } from '@/src/utils/Area'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'

type State = {
  btnStatus: BtnStatus
}

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive<State>({
      btnStatus: {
        area: false,
        takeout: false,
        openBuz: false,
        nowLocation: false
      } as BtnStatus
    })

    const { areas } = useArea(context.root)

    const { shops } = useShop(context.root)

    const filterAreas = computed(() => {
      const areasQuery = context.root.$route.query.areas
      return filterAreasByID(areas.value, areasQuery)
    })

    const filterShopsByArea = computed(() => {
      return filterShopsByAreas(shops.value, filterAreas.value)
    })

    const filterShops = computed(() => {
      if (state.btnStatus.takeout) {
        return filterShopsByArea.value.filter((shop: Shop) => shop.canTakeout)
      }

      return filterShopsByArea.value
    })

    return {
      areas,
      shops,
      state,
      filterShops
    }
  },

  head: (): MetaInfo => ({
    title: '詳細検索',
    meta: [
      { property: 'og:type', content: 'article' }
    ]
  })
})
</script>

<style lang="scss">
.to-detail-search {
  font-size: 0.8rem;
  text-decoration: none;

  &::before {
    content: '←';
  }
}
</style>
