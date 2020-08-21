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

    <DefaultShopList :shops="filterShops" :max-item="state.shops.length" />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { Area } from '@/src/types/Area'
import { getAreaList } from '@/src/infra/firestore/Area'
import { isString } from '@/src/utils/String'
import { getShopList } from '@/src/infra/firestore/Shop'
import { BtnStatus } from '@/components/molecules/button_group/SearchButtonGroup.vue'
import { MetaInfo } from 'vue-meta'

type State = {
  areas: Area[],
  btnStatus: BtnStatus,
  shops: Shop[]
}

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive<State>({
      areas: [] as Area[],
      btnStatus: {
        area: false,
        takeout: false,
        openBuz: false,
        nowLocation: false
      } as BtnStatus,
      shops: [] as Shop[]
    })

    const filterAreas = computed(() => {
      const areasQuery = context.root.$route.query.areas
      return state.areas.filter((area: Area) => {
        if (isString(areasQuery)) {
          return area.id === areasQuery
        }
        return areasQuery.includes(area.id)
      })
    })

    const filterShopsByArea = computed(() => {
      const addresses = filterAreas.value.reduce((pv, area) => {
        return [...pv, ...area.addresses]
      }, [] as string[])

      return state.shops.filter((shop: Shop) => {
        if (!shop.address) {
          return false
        }

        for (const address of addresses) {
          if (shop.address.includes(address)) {
            return true
          }
        }

        return false
      })
    })

    const filterShops = computed(() => {
      if (state.btnStatus.takeout) {
        return filterShopsByArea.value.filter((shop: Shop) => shop.canTakeout)
      }

      return filterShopsByArea
    })

    watchEffect(async () => {
      state.areas = await getAreaList(context.root.$fireStore)
    })

    watchEffect(async () => {
      state.shops = await getShopList(context.root.$fireStore)
    })

    return {
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
