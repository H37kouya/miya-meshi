<template>
  <div>
    <ShopText :level="2">
      店舗写真
    </ShopText>

    <div class="d-flex justify-center pa-8">
      <v-img
        v-if="screenSm"
        alt="現在準備中 - 完成をお待ちください"
        src="/s/now-working.png"
      />

      <v-img
        v-else
        alt="現在準備中 - 完成をお待ちください"
        src="/s/now-working-mobile.png"
      />
    </div>
  </div>
</template>

<script>
import { defineComponent } from '@nuxtjs/composition-api'
import { useGetScreenSize } from '~/src/CompositonFunctions/utils/UseGetScreenSize'

export default defineComponent({
  props: {
    shop: {
      type: Object,
      default: undefined
    },

    menus: {
      type: Array,
      default: () => []
    }
  },

  setup () {
    const { screenSm } = useGetScreenSize

    return {
      screenSm
    }
  }
})
</script>
