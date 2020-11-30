<template>
  <div>
    <PcTopShopField :shop="shop" />

    <template v-if="menus.length > 0">
      <div>
        <ShopText :level="2">
          おすすめの3品
        </ShopText>

        <RecommendShopField :menus="menus.slice(0, 3)" />
      </div>
    </template>

    <template v-if="posts.length > 0">
      <ShopText :level="2">
        このお店の記事を見る
      </ShopText>

      <v-row>
        <v-col v-for="post in posts" :key="post.id" cols="12" md="6">
          <BlogCard :post="post" />
        </v-col>
      </v-row>
    </template>

    <template v-if="menuImages.length > 0">
      <div>
        <ShopText :level="2">
          メニュー
        </ShopText>

        <MenuImageShopField :src="menuImages" />
      </div>
    </template>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from '@nuxtjs/composition-api'
import { Menu, Post, Shop } from '@/lib'

type Props = {
  shop: Shop
  menus: Menu[]
  posts: Post[]
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
    },

    posts: {
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
