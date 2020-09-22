<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <v-container class="pa-0">
      <v-row class="mx-0">
        <v-col cols="12" md="8" class="px-0 px-md-3">
          <MainText id="result_detail_search">
            詳細検索結果
          </MainText>

          <div>
            <SearchAreaAndKyewordField
              :area="nowArea"
            />
          </div>

          <DefaultShopList :shops="displayShops" :max-item="shops.length" />
        </v-col>

        <v-col cols="12" md="4" class="d-none d-md-block">
          <div class="area-container mb-8">
            <h3 class="area-title">
              エリアから探す
            </h3>

            <div class="search-now-location d-flex justify-space-between pa-4">
              <p class="mb-0">
                現在地から探す
              </p>

              <v-icon>
                mdi-chevron-right
              </v-icon>
            </div>

            <div class="px-4 py-2">
              <v-chip-group>
                <v-chip small filter outlined value="canTakeout">
                  テイクアウト可
                </v-chip>
              </v-chip-group>

              <p class="text-right mb-0">
                <nuxt-link to="/keywords/detail" class="to-keyword-detail">
                  詳細検索
                </nuxt-link>
              </p>
            </div>
          </div>

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
import { computed, defineComponent, useContext } from '@nuxtjs/composition-api'
import { SetupContext } from '@nuxtjs/composition-api'
import { MetaInfo } from 'vue-meta'
import { Breadcrumb, Shop } from '@/lib'
import { filterShopsByAreas, filterShopsByDishes } from '@/src/utils/Shop'
import { filterAreasByID } from '@/src/utils/Area'
import { filterDishesByID } from '@/src/utils/Dish'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'
import { isString } from '@/src/utils/String'
import { useDish } from '@/src/CompositonFunctions/dishes/UseDishes'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: '検索', to: '/keywords' },
  { exact: true, text: '詳細検索', to: '/keywords/detail' },
  { text: '検索結果', to: '/search' }
] as Breadcrumb[]

export default defineComponent({
  setup (_, context: SetupContext) {
    const { query } = useContext()

    const { areas, nowArea } = useArea(context.root)
    const { shops } = useShop(context.root)
    const { dishes } = useDish(context.root)

    const filterAreas = computed(() => {
      const areasQuery = query.value.areas
      return filterAreasByID(areas.value, areasQuery)
    })

    const filterDishes = computed(() => {
      const dishesQuery = query.value.dishes
      return filterDishesByID(dishes.value, dishesQuery)
    })

    const filterShopsByArea = computed(() => {
      if (filterAreas.value.length === 0) {
        return shops.value
      }
      return filterShopsByAreas(shops.value, filterAreas.value)
    })

    const filterShopsByTime = computed(() => {
      const timezonesQuery = query.value.timezones
      if (!timezonesQuery) {
        return filterShopsByArea.value
      }

      const mappedTimeZonesQuery = [] as string[]
      if (isString(timezonesQuery)) {
        timezonesQuery === 'morning' && mappedTimeZonesQuery.push('朝')
        timezonesQuery === 'lunch' && mappedTimeZonesQuery.push('昼')
        timezonesQuery === 'night' && mappedTimeZonesQuery.push('夜')
      } else {
        for (const timezone of timezonesQuery) {
          timezone === 'morning' && mappedTimeZonesQuery.push('朝')
          timezone === 'lunch' && mappedTimeZonesQuery.push('昼')
          timezone === 'night' && mappedTimeZonesQuery.push('夜')
        }
      }

      if (mappedTimeZonesQuery.length === 3) {
        return filterShopsByArea.value
      }

      return filterShopsByArea.value.filter((shop: Shop) => {
        if (!shop.timeZone) {
          return false
        }

        for (const timezone of shop.timeZone) {
          if (mappedTimeZonesQuery.includes(timezone)) {
            return true
          }
        }
      })
    })

    const filterShopsByDish = computed(() => {
      if (filterDishes.value.length === 0) {
        return filterShopsByTime.value
      }
      return filterShopsByDishes(filterShopsByTime.value, filterDishes.value)
    })

    const displayShops = computed(() => {
      return filterShopsByDish.value
    })

    return {
      areas,
      breadcrumbs,
      displayShops,
      nowArea,
      shops
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
