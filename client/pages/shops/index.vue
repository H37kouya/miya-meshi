<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <v-container class="pa-0">
      <v-row class="mx-0">
        <v-col cols="12" md="8" class="px-0 px-md-3 pt-0">
          <MainText>
            お店から探す
          </MainText>

          <div>
            <SearchAreaAndKyewordField
              :area="nowArea"
              :value="searchAreasAndCanTakeout"
              @updateNowArea="onUpdateNowArea"
              @change="onChangeSearch"
            />
          </div>

          <div>
            <div class="sales-title">
              <h3 class="pl-4 pt-4">
                営業中
              </h3>
            </div>

            <DefaultShopList
              :areas="areas"
              :shops="filterShopsByCanTakeout"
              :max-item="shops.length"
              :now-page="nowPage"
            />
          </div>
        </v-col>

        <v-col cols="12" md="4" class="d-none d-md-block">
          <SearchAreaField
            :areas="areas"
            :now-area="nowArea"
            :value="searchAreas"
            @change="onChangeSearchAreas"
            @updateNowArea="onUpdateNowArea"
          />

          <div class="area-container">
            <h3 class="area-title">
              ジャンルから探す
            </h3>

            <div class="search-now-location d-flex justify-space-between pa-4">
              <p class="mb-0">
                すべて
              </p>

              <v-icon>
                mdi-chevron-right
              </v-icon>
            </div>

            <div class="px-4 py-2">
              <p class="text-right mb-0">
                <nuxt-link to="/keywords/detail" class="to-keyword-detail">
                  ジャンル検索
                </nuxt-link>
              </p>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { MetaInfo } from 'vue-meta'
import { Breadcrumb, Shop } from '@/lib'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'
import { isArray } from '@/src/utils/Array'
import { isString } from '@/src/utils/String'
import { filterShopsByAreas } from '~/src/utils/Shop'
import { filterAreasByID } from '~/src/utils/Area'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { text: 'お店から探す', to: '/shops' }
] as Breadcrumb[]

export default defineComponent({
  watchQuery: ['page'],

  setup (_, context: SetupContext) {
    const { areas, nowArea, onUpdateNowArea } = useArea(context.root)

    const { shops } = useShop(context.root)

    const nowPage = computed(() => {
      const page = context.root.$route.query.page
      if (isArray(page)) {
        return 1
      }

      const pageNumber = Number(page)
      return Number.isInteger(pageNumber) ? pageNumber : 1
    })

    const searchAreasAndCanTakeout = computed(() => {
      const _canTakeout = context.root.$route.query.canTakeout
      if (isArray(_canTakeout)) {
        return searchAreas.value
      }

      if (isString(_canTakeout)) {
        return [
          ...searchAreas.value,
          'canTakeout'
        ]
      }

      return searchAreas.value
    })

    const searchAreas = computed(() => {
      const _searchAreas = context.root.$route.query.areas
      if (isArray(_searchAreas)) {
        return _searchAreas
      }

      if (isString(_searchAreas)) {
        return [_searchAreas]
      }

      return []
    })

    const onChangeSearch = async (value: string[]) => {
      const query = {
        areas: [] as string[]
      } as {
        areas?: string[]
        canTakeout?: 'true'
      }

      for (const v of value) {
        if (v.includes('canTakeout')) {
          query.canTakeout = 'true'
        } else {
          query.areas && query.areas.push(v)
        }
      }

      return await context.root.$router.push({
        path: '/shops',
        query: {
          areas: query.areas && query.areas.length > 0 ? query.areas : undefined,
          canTakeout: query.canTakeout
        }
      })
    }

    const onChangeSearchAreas = async (areas: string[]) => {
      return await context.root.$router.push({
        path: '/shops',
        query: {
          areas
        }
      })
    }

    const filterAreas = computed(() => {
      const areasQuery = context.root.$route.query.areas
      return filterAreasByID(areas.value, areasQuery)
    })

    const filterShopsByArea = computed(() => {
      if (filterAreas.value.length === 0) {
        return shops.value
      }
      return filterShopsByAreas(shops.value, filterAreas.value)
    })

    const filterShopsByCanTakeout = computed(() => {
      const _canTakeout = context.root.$route.query.canTakeout
      if (isString(_canTakeout)) {
        return filterShopsByArea.value.filter((shop: Shop) => shop.canTakeout)
      }

      return filterShopsByArea.value
    })

    return {
      areas,
      breadcrumbs,
      nowArea,
      filterShopsByCanTakeout,
      shops,
      searchAreas,
      searchAreasAndCanTakeout,
      nowPage,
      onChangeSearch,
      onUpdateNowArea,
      onChangeSearchAreas
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

<style lang="scss" scoped>
.sales-title {
  border-bottom: 1px solid #d5ceb7;

  h3 {
    font-size: 1.1rem;
    font-weight: bolder;
  }
}

.area-container {
  border: 1rem #f6f6f6 solid;
}

.area-title {
  font-size: 1.1rem;
  font-weight: bolder;
  padding: 1rem;
}

.search-now-location {
  color: #5a5041;
  background: #faf8f5;
  font-weight: bolder;
}

.to-keyword-detail {
  font-size: 0.8rem;
}
</style>
