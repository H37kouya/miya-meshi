<template>
  <div class="u-light-grey-background white-md-background">
    <v-container class="pb-2">
      <div v-if="maxItem" class="text-right">
        <p class="mb-1 display-count">
          <span class="red--text">{{ pagination.shops.length }}件</span>表示中/全{{ maxItem }}件中
        </p>
      </div>

      <v-row class="px-1" :justify="justify">
        <template v-if="pagination.shops.length > 0">
          <template v-for="(shop, key) in pagination.shops">
            <v-col :key="key" cols="6" class="px-1 pt-2 pb-sm-4">
              <ShopCard
                :alt="`${shop.name} - thumnails`"
                :area="computedShopArea(shop.address)"
                :can-takeout="shop.canTakeout"
                :can-go-to-eat="shop.canGoToEat"
                :to="`/shops/${shop.id}`"
                :src="shop.imageLink"
                :name="shop.name"
                :prefix-name="shop.prefixName"
                :price-range="shop.priceRange"
              />
            </v-col>
          </template>
        </template>

        <template v-else>
          <v-col>
            <p class="mb-0 text-center">
              条件に見合うお店が見つかりませんでした。
            </p>
          </v-col>
        </template>
      </v-row>

      <div v-if="pagination.totalVisible !== 1">
        <v-pagination
          :value="nowPage"
          :length="pagination.totalVisible"
          @input="onPagination"
        />
      </div>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent, computed, reactive, SetupContext, watch } from '@nuxtjs/composition-api'
import { Area, Shop } from '@/lib'
import { computedShortShopAddress, getShopAreaByAddress } from '@/src/utils/Shop'

type Query = {
  areas: string[],
  dishes: string[],
  canTakeout: string,
  timezones: string[]
}

type Props = {
  areas: Area[],
  shops: Shop[],
  maxItem: number,
  nowPage: number,
  query: Query
}
export default defineComponent({
  props: {
    areas: {
      type: Array,
      default: () => []
    },

    shops: {
      type: Array,
      default: () => []
    },

    maxItem: {
      type: Number,
      default: 0
    },

    justify: {
      type: String,
      default: 'start'
    },

    nowPage: {
      type: Number,
      default: 1
    },

    query: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      shops: props.shops
    })

    const computedShopArea = computed(() => {
      return (address: Shop['address']) => {
        if (props.areas) {
          const area = getShopAreaByAddress(address, props.areas)
          if (area) {
            return area.name
          }
        }

        if (address) {
          if (address.includes('宇都宮')) {
            return computedShortShopAddress(address)
          } else {
            return '宇都宮市外'
          }
        }

        return undefined
      }
    })

    const pagination = computed(() => {
      return {
        shops: state.shops.slice((props.nowPage - 1) * 10, props.nowPage * 10),
        totalVisible: Math.floor(state.shops.length / 10) + 1
      }
    })

    watch(() => props.shops, (newVal, _) => {
      state.shops = newVal
    })

    const onPagination = async (page: number) => {
      if (props.query.areas && props.query.areas.length === 1) {
        return await context.root.$router.push({
          path: `/shops/area/${props.query.areas[0]}`,
          hash: context.root.$route.hash === 'title1' ? 'title2' : 'title1',
          query: {
            page: String(page),
            dishes: props.query.dishes,
            canTakeout: props.query.canTakeout,
            timezones: props.query.timezones
          }
        })
      }

      return await context.root.$router.push({
        path: '/shops',
        hash: context.root.$route.hash === 'title1' ? 'title2' : 'title1',
        query: {
          page: String(page),
          areas: props.query.areas,
          dishes: props.query.dishes,
          canTakeout: props.query.canTakeout,
          timezones: props.query.timezones
        }
      })
    }

    return {
      computedShopArea,
      state,
      pagination,
      onPagination
    }
  }
})
</script>

<style lang="scss" scoped>
.display-count {
  font-size: 0.8rem;
}
</style>
