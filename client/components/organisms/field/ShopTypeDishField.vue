<template>
  <div>
    <div>
      <ShopText :level="2">
        おすすめの3品
      </ShopText>

      <RecommendShopField :menus="menus" />
    </div>

    <div>
      <ShopText :level="2">
        料理一覧
      </ShopText>
    </div>

    <div>
      <DefaultMenuList :menus="menus" />
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
