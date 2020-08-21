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

    <DefaultShopList :shops="displayShops" :max-item="state.shops.length" />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { getShopList } from '@/src/infra/firestore/Shop'
import { BtnStatus } from '@/components/molecules/button_group/SearchButtonGroup.vue'
import { MetaInfo } from 'vue-meta'
import { ActionType } from '~/store/areas'
import { Area } from '~/src/types/Area'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      shops: [] as Shop[],
      btnStatus: {
        area: false,
        takeout: false,
        openBuz: false,
        nowLocation: false
      } as BtnStatus
    })

    const displayShops = computed(() => {
      if (state.btnStatus.takeout && state.btnStatus.nowLocation) {
        return state.shops.filter((shop: Shop) => {
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
        return state.shops.filter((shop: Shop) => shop.canTakeout)
      }

      if (state.btnStatus.nowLocation) {
        return state.shops.filter((shop: Shop) => {
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

      return state.shops
    })

    const nowArea = computed(() => {
      return context.root.$store.getters['areas/nowArea'] as Area|undefined
    })

    watchEffect(async () => {
      state.shops = await getShopList(context.root.$fireStore, 0)
    })

    watchEffect(async () => {
      await context.root.$store.dispatch(`areas/${ActionType.FETCH_AREAS}`)
    })

    return {
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
