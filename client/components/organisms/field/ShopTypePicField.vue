<template>
  <div>
    <ShopText :level="2">
      店舗写真
    </ShopText>

    <div class="d-flex justify-center">
      <v-img
        alt="現在準備中 - 完成をお待ちください"
        src="/s/now-working.png"
      />
    </div>
  </div>
</template>

<script>
import { defineComponent } from '@nuxtjs/composition-api'

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
  }
})
</script>
