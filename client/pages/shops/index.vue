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

    <DefaultShopList :shops="displayShops" />
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { getShopList } from '@/src/infra/firestore/Shop'
import { BtnStatus } from '@/components/molecules/button_group/SearchButtonGroup.vue'

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
      if (state.btnStatus.takeout) {
        return state.shops.filter((shop: Shop) => shop.canTakeout)
      }

      return state.shops
    })

    watchEffect(async () => {
      state.shops = await getShopList(context.root.$fireStore)
    })

    return {
      displayShops,
      state
    }
  }
})
</script>
