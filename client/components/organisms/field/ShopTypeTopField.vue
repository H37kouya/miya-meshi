<template>
  <div>
    <PcTopShopField :shop="shop" />

    <div v-if="menus.length > 0">
      <ShopText :level="2">
        おすすめの3品
      </ShopText>

      <RecommendShopField :menus="menus.slice(0, 3)" />

      <template v-if="menuImages.length > 0">
        <MenuImageShopField :src="menuImages" />
      </template>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from '@nuxtjs/composition-api'
import { Menu, Shop } from '@/lib'

type Props = {
  shop: Shop,
  menus: Menu[]
}
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

  setup (props: Props) {
    const menuImageLinkRemovedNoImages = computed(() => {
      return props.shop.menuImageLink
        ? props.shop.menuImageLink.filter((image: string) => image !== '/no-image.png')
        : []
    })

    return {
      menuImages: menuImageLinkRemovedNoImages
    }
  }
})
</script>
