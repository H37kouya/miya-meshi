<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container mb-2">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <v-container class="pa-0">
      <v-row class="mx-0">
        <v-col cols="12" md="8" class="px-0 px-md-3 py-0">
          <div id="title1" class="header-shop-list-container">
            <div v-if="!screenMd" class="d-md-none">
              <MainText>
                お店から探す
              </MainText>
            </div>

            <div v-if="screenMd" class="d-none d-md-block">
              <h1 class="shop-list-title px-4 pt-6 pb-4">
                お店から探す
              </h1>
            </div>

            <div>
              <SearchAreaAndKyewordField
                :area="nowArea"
                :value="searchAreasAndCanTakeout"
                :to-keyword-detail="toKeywordDetail"
                :selected-area="selectedArea"
                @updateNowArea="onUpdateNowArea"
                @change="onChangeSearch"
              />
            </div>
          </div>

          <div>
            <div class="border-b border-dark-gray">
              <h3 class="pl-4 pt-4">
                営業中
              </h3>
            </div>

            <DefaultShopList
              :areas="areas"
              :shops="filterShopsByName"
              :max-item="filterShopsByName.length"
              :now-page="nowPage"
              :query="nowQuery"
            />
          </div>
        </v-col>

        <v-col cols="12" md="4" class="d-none d-md-block pt-0">
          <SearchNameField
            v-model="state.searchName"
          />

          <SearchAreaField
            :areas="areas"
            :now-area="nowArea"
            :value="searchAreas"
            @change="onChangeSearchAreas"
            @updateNowArea="onUpdateNowArea"
          />

          <div class="mb-8">
            <SearchDishField
              :dishes="dishes"
              :value="searchDishes"
              @change="onChangeSearcDishes"
            />
          </div>

          <div>
            <v-card href="https://forms.gle/gAknXAaCrfsr8UdA8" target="_blank" rel="noopener" flat>
              <v-img src="/s/recruitment-shop.png" alt="掲載希望の方はこちら" />
            </v-card>
          </div>

          <div class="mt-8">
            <adsbygoogle
              ad-slot="7220123703"
            />
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, useContext } from '@nuxtjs/composition-api'
import { Breadcrumb, Shop } from '@/lib'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'
import { isArray, nullOrStringArrayToStringArray } from '@/src/utils/Array'
import { isString } from '@/src/utils/String'
import { filterShopsByAreas, filterShopsByDishIDs } from '@/src/utils/Shop'
import { filterAreasByID } from '@/src/utils/Area'
import { useGetScreenSize } from '@/src/CompositonFunctions/utils/UseGetScreenSize'
import { useDish } from '@/src/CompositonFunctions/dishes/UseDishes'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { text: 'お店から探す', to: '/shops' }
] as Breadcrumb[]

export default defineComponent({
  setup () {
    const { store, redirect, query } = useContext()
    const { areas, nowArea, onUpdateNowArea } = useArea(store)

    const state = reactive({
      searchName: ''
    })

    const { shops } = useShop(store)
    const { screenMd } = useGetScreenSize()
    const { dishes } = useDish(store)

    const nowPage = computed(() => {
      const page = query.value.page
      if (isArray(page)) {
        return 1
      }

      const pageNumber = Number(page)
      return Number.isInteger(pageNumber) ? pageNumber : 1
    })

    const searchAreasAndCanTakeout = computed(() => {
      const _canTakeout = query.value.canTakeout
      if (isArray(_canTakeout)) {
        return [
          ...searchAreas.value,
          ...searchTimezones.value
        ]
      }

      if (isString(_canTakeout)) {
        return [
          ...searchAreas.value,
          ...searchTimezones.value,
          'canTakeout'
        ]
      }

      return [
        ...searchAreas.value,
        ...searchTimezones.value
      ]
    })

    const searchAreas = computed(() => {
      const _searchAreas = query.value.areas
      if (isArray(_searchAreas)) {
        return nullOrStringArrayToStringArray(_searchAreas)
      }

      if (isString(_searchAreas)) {
        return [_searchAreas]
      }

      return []
    })

    const searchDishes = computed(() => {
      const _searchDishes = query.value.dishes
      if (isArray(_searchDishes)) {
        return nullOrStringArrayToStringArray(_searchDishes)
      }

      if (isString(_searchDishes)) {
        return [_searchDishes]
      }

      return []
    })

    const searchTimezones = computed(() => {
      const _searchTimezones = query.value.timezones
      if (isArray(_searchTimezones)) {
        return nullOrStringArrayToStringArray(_searchTimezones)
      }

      if (isString(_searchTimezones)) {
        return [_searchTimezones]
      }

      return []
    })

    const onChangeSearch = async (value: string[]) => {
      const _query = {
        areas: [] as string[],
        timezones: [] as string[]
      } as {
        areas?: string[],
        timezones?: string[],
        canTakeout?: 'true'
      }

      for (const v of value) {
        if (v.includes('canTakeout')) {
          _query.canTakeout = 'true'
        } else if (['morning', 'lunch', 'night'].includes(v)) {
          _query.timezones && _query.timezones.push(v)
        } else {
          _query.areas && _query.areas.push(v)
        }
      }

      const _dishes = query.value.dishes

      if (_query.areas && _query.areas.length === 1) {
        return await redirect({
          path: `/shops/area/${_query.areas}`,
          query: {
            dishes: isArray(_dishes) && _dishes.length > 0 ? _dishes : undefined,
            timezones: _query.timezones && _query.timezones.length > 0 ? _query.timezones : undefined,
            canTakeout: _query.canTakeout
          }
        })
      }

      return await redirect({
        path: '/shops',
        query: {
          areas: _query.areas && _query.areas.length > 0 ? _query.areas : undefined,
          dishes: isArray(_dishes) && _dishes.length > 0 ? _dishes : undefined,
          timezones: _query.timezones && _query.timezones.length > 0 ? _query.timezones : undefined,
          canTakeout: _query.canTakeout
        }
      })
    }

    const onChangeSearchAreas = async (areas: string[]) => {
      const _canTakeout = query.value.canTakeout
      const _dishes = query.value.dishes
      const _timezones = query.value.timezones

      if (areas.length === 1) {
        return await redirect({
          path: `/shops/area/${areas[0]}`,
          query: {
            dishes: isArray(_dishes) && _dishes.length > 0 ? _dishes : undefined,
            timezones: isArray(_timezones) && _timezones.length > 0 ? _timezones : undefined,
            canTakeout: isString(_canTakeout) ? _canTakeout : undefined
          }
        })
      }

      return await redirect({
        path: '/shops',
        query: {
          areas,
          dishes: isArray(_dishes) && _dishes.length > 0 ? _dishes : undefined,
          timezones: isArray(_timezones) && _timezones.length > 0 ? _timezones : undefined,
          canTakeout: isString(_canTakeout) ? _canTakeout : undefined
        }
      })
    }

    const onChangeSearcDishes = async (dishes: string[]) => {
      const _canTakeout = query.value.canTakeout
      const _areas = query.value.areas
      const _timezones = query.value.timezones

      return await redirect({
        path: '/shops',
        query: {
          areas: isArray(_areas) && _areas.length > 0 ? _areas : undefined,
          dishes,
          timezones: isArray(_timezones) && _timezones.length > 0 ? _timezones : undefined,
          canTakeout: isString(_canTakeout) ? _canTakeout : undefined
        }
      })
    }

    const filterAreas = computed(() => {
      const areasQuery = query.value.areas
      return filterAreasByID(areas.value, areasQuery)
    })

    const filterShopsByArea = computed(() => {
      if (filterAreas.value.length === 0) {
        return shops.value
      }
      return filterShopsByAreas(shops.value, filterAreas.value)
    })

    const filterShopsByCanTakeout = computed(() => {
      const _canTakeout = query.value.canTakeout
      if (isString(_canTakeout)) {
        return filterShopsByArea.value.filter((shop: Shop) => shop.canTakeout)
      }

      return filterShopsByArea.value
    })

    const filterShopsByDish = computed(() => {
      if (searchDishes.value.length === 0) {
        return filterShopsByCanTakeout.value
      }
      return filterShopsByDishIDs(filterShopsByCanTakeout.value, searchDishes.value)
    })

    const filterShopsByTime = computed(() => {
      const timezonesQuery = searchTimezones
      const _originalShops: Shop[] = filterShopsByDish.value
      if (timezonesQuery.value.length === 0) {
        return _originalShops
      }
      const mappedTimeZonesQuery = [] as string[]
      for (const timezone of timezonesQuery.value) {
        timezone === 'morning' && mappedTimeZonesQuery.push('朝')
        timezone === 'lunch' && mappedTimeZonesQuery.push('昼')
        timezone === 'night' && mappedTimeZonesQuery.push('夜')
      }

      if (mappedTimeZonesQuery.length === 0 || mappedTimeZonesQuery.length >= 3) {
        return _originalShops
      }

      return _originalShops.filter((shop: Shop) => {
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

    const filterShopsByName = computed(() => {
      const shops = filterShopsByTime.value

      if (!state.searchName) {
        return shops
      }

      const _nameToLower = state.searchName.toLowerCase()
      return shops.filter((shop: Shop) => {
        if (_nameToLower && shop.name && !shop.name.toLowerCase().includes(_nameToLower)) {
          return false
        }

        if (_nameToLower && shop.nameKana && !shop.nameKana.toLowerCase().includes(_nameToLower)) {
          return false
        }


        return true
      })
    })

    const nowQuery = computed(() => {
      const _canTakeout = query.value.canTakeout
      const _areas = query.value.areas
      const _dishes = query.value.dishes
      const _timezones = query.value.timezones

      return {
        areas: _areas,
        dishes: _dishes,
        timezones: _timezones,
        canTakeout: isString(_canTakeout) ? _canTakeout : undefined
      }
    })

    const toKeywordDetail = computed(() => ({
      path: '/keywords/area',
      query: {
        ...nowQuery.value
      }
    }))

    const selectedArea = computed(() => {
      const _areas = filterAreasByID(areas.value, searchAreas.value)

      if (_areas.length === 0) {
        return 'すべて'
      }

      return _areas[0].name
    })

    return {
      areas,
      breadcrumbs,
      dishes,
      state,
      nowArea,
      nowQuery,
      filterShopsByName,
      screenMd,
      shops,
      searchAreas,
      searchAreasAndCanTakeout,
      searchDishes,
      searchTimezones,
      selectedArea,
      nowPage,
      toKeywordDetail,
      onChangeSearch,
      onUpdateNowArea,
      onChangeSearchAreas,
      onChangeSearcDishes
    }
  },

  head: () => ({
    title: 'お店から探す'
  }),

  watchQuery: ['page']
})
</script>

<style lang="scss" scoped>
.shop-list-title {
  font-size: 1.5rem;
  font-weight: bolder;
}

.header-shop-list-container {
  @include mq(sm) {
    background: #faf8f5;
  }
}

.sales-title {
  h3 {
    font-size: 1.1rem;
    font-weight: bolder;
  }
}

.area-container {
  border: 1rem #faf8f5 solid;
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
