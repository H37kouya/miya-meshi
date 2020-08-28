<template>
  <div>
    <MainText id="result_detail_search">
      詳細検索結果
    </MainText>

    <div class="u-light-grey-background pt-3">
      <v-container>
        <p class="mb-0">
          <nuxt-link to="/keywords/detail" class="to-detail-search">
            詳細検索に戻る
          </nuxt-link>
        </p>
      </v-container>

      <SearchButtonGroup
        :btn-status="btnStatus"
        @input="(v) => btnStatus = v"
      />
    </div>

    <DefaultShopList :shops="displayShops" :max-item="shops.length" />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { Shop } from '@/lib'
import { MetaInfo } from 'vue-meta'
import { filterShopsByAreas } from '@/src/utils/Shop'
import { filterAreasByID } from '@/src/utils/Area'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'
import { useBtnStatus } from '~/src/CompositonFunctions/btnStatus/UseBtnStatus'
import { useFilterShopByBtnStatus } from '~/src/CompositonFunctions/btnStatus/UseFilterShopByBtnStatus'

export default defineComponent({
  setup (_, context: SetupContext) {
    const { btnStatus } = useBtnStatus(context)

    const { areas } = useArea(context.root)

    const { nowArea } = useArea(context.root)

    const { shops } = useShop(context.root)

    const filterAreas = computed(() => {
      const areasQuery = context.root.$route.query.areas
      return filterAreasByID(areas.value, areasQuery)
    })

    const filterShopsByArea = computed(() => {
      return filterShopsByAreas(shops.value, filterAreas.value)
    })

    const { displayShops } = useFilterShopByBtnStatus(btnStatus, filterShopsByArea, nowArea)

    return {
      areas,
      displayShops,
      shops,
      btnStatus
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
