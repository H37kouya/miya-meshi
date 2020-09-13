<template>
  <div>
    <MainText id="result_detail_search">
      詳細検索結果
    </MainText>

    <div class="u-light-grey-background pt-3">
      <v-container class="py-0">
        <v-breadcrumbs :items="breadcrumbs" class="pb-0 px-0 px-sm-6" />
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
import { computed, defineComponent, useContext } from '@nuxtjs/composition-api'
import { SetupContext } from '@vue/composition-api'
import { MetaInfo } from 'vue-meta'
import { Shop } from '@/lib'
import { filterShopsByAreas } from '@/src/utils/Shop'
import { filterAreasByID } from '@/src/utils/Area'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'
import { useBtnStatus } from '~/src/CompositonFunctions/btnStatus/UseBtnStatus'
import { useFilterShopByBtnStatus } from '~/src/CompositonFunctions/btnStatus/UseFilterShopByBtnStatus'
import { isString } from '~/src/utils/String'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: '検索', to: '/keywords' },
  { exact: true, text: '詳細検索', to: '/keywords/detail' },
  { text: '検索結果', to: '/search' }
] as
Partial<{
  disabled: boolean
  exact: boolean
  href: string
  link: boolean
  text: string | number
  to: string | object
}>[]

export default defineComponent({
  setup (_, context: SetupContext) {
    const { query } = useContext()

    const { btnStatus } = useBtnStatus(context)
    const { areas } = useArea(context.root)
    const { nowArea } = useArea(context.root)
    const { shops } = useShop(context.root)

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

    const { displayShops } = useFilterShopByBtnStatus(btnStatus, filterShopsByTime, nowArea)

    return {
      areas,
      breadcrumbs,
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

<style lang="scss" scoped>
.to-detail-search {
  font-size: 0.8rem;
  text-decoration: none;

  &::before {
    content: '←';
  }
}
</style>
