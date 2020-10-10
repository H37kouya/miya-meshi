<template>
  <div>
    <PcTopShopField :shop="shop" />

    <div v-if="menus.length > 0">
      <ShopText :level="2">
        おすすめの3品
      </ShopText>

      <RecommendShopField :menus="menus.slice(0, 3)" />
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
