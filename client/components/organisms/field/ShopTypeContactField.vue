<template>
  <div>
    <ShopText :level="2">
      {{ screenMd ? '地図・お問い合わせ' : '地図' }}
    </ShopText>

    <div class="pa-2">
      <LazyMap :latitude="shop.latitude" :longitude="shop.longitude" :width="640" />
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
    const { screenMd } = useGetScreenSize

    return {
      screenMd
    }
  }
})
</script>
