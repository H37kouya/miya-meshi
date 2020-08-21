<template>
  <div>
    <DefaultMainText>
      お店から探す
    </DefaultMainText>

    <div class="u-light-grey-background pt-3">
      <SearchButtonGroup
        :btn-status="state.btnStatus"
        @input="(v) => state.btnStatus = v"
      />
    </div>

    <DefaultShopList :shops="displayShops" :max-item="shops.length" />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { BtnStatus } from '@/components/molecules/button_group/SearchButtonGroup.vue'
import { MetaInfo } from 'vue-meta'
import { useArea } from '@/src/CompositonFunctions/areas/UseArea'
import { useShop } from '@/src/CompositonFunctions/shops/UseShop'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      btnStatus: {
        area: false,
        takeout: false,
        openBuz: false,
        nowLocation: false
      } as BtnStatus
    })

    const { nowArea } = useArea(context.root)

    const { shops } = useShop(context.root)

    const displayShops = computed(() => {
      if (state.btnStatus.takeout && state.btnStatus.nowLocation) {
        return shops.value.filter((shop: Shop) => {
          if (!shop.canTakeout || !shop.address || !nowArea.value) {
            return false
          }

          for (const address of nowArea.value.addresses) {
            if (shop.address.includes(address)) {
              return true
            }
          }

          return false
        })
      }

      if (state.btnStatus.takeout) {
        return shops.value.filter((shop: Shop) => shop.canTakeout)
      }

      if (state.btnStatus.nowLocation) {
        return shops.value.filter((shop: Shop) => {
          if (!shop.address || !nowArea.value) {
            return false
          }

          for (const address of nowArea.value.addresses) {
            if (shop.address.includes(address)) {
              return true
            }
          }

          return false
        })
      }

      return shops.value
    })

    return {
      shops,
      displayShops,
      state
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
