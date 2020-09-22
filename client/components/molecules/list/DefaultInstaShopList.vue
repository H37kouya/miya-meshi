<template>
  <div class="u-light-grey-background white-md-background">
    <v-container class="pb-2">
      <div v-if="maxItem" class="text-right">
        <p class="mb-1 display-count">
          <span class="red--text">{{ state.shops.length }}件</span>表示中/全{{ maxItem }}件中
        </p>
      </div>

      <v-row class="px-1" :justify="justify">
        <template v-if="state.shops.length > 0">
          <template v-for="(shop, key) in state.shops">
            <v-col :key="key" cols="4" class="px-1 py-1 pb-sm-4">
              <InstaCard
                :alt="shop.name"
                :address="shortAddress(shop.address)"
                :prefix-name="shop.prefixName"
                :name="shop.name"
                :to="`/shops/${shop.id}`"
                :src="shop.imageLink"
                :insta-number="shop.instaNumber"
              />
            </v-col>
          </template>
        </template>

        <template v-else>
          <v-col class="d-flex justify-center align-center not-founds">
            <p class="mb-0 text-center">
              条件に見合うお店が見つかりませんでした。
            </p>
          </v-col>
        </template>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watch } from '@nuxtjs/composition-api'
import { Shop } from '@/lib'
import { computedShortShopAddress } from '~/src/utils/Shop'

type Props = {
  shops: Shop[],
  maxItem: number
}
export default defineComponent({
  props: {
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
    }
  },

  setup (props: Props, _: SetupContext) {
    const state = reactive({
      shops: props.shops
    })

    const shortAddress = computed(() => {
      return (address: Shop['address']) => computedShortShopAddress(address)
    })

    watch(() => props.shops, (newVal, _) => {
      state.shops = newVal
    })

    return {
      shortAddress,
      state
    }
  }
})
</script>

<style lang="scss" scoped>
.not-founds {
  height: 160px;
}

.display-count {
  font-size: 0.8rem;
}
</style>
