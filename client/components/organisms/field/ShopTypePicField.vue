<template>
  <div>
    <ShopText :level="2">
      店舗写真
    </ShopText>

    <template v-if="appearanceImageLinkRemovedNoImages.length === 0">
      <div class="text-center pt-4">
        <h3 class="now-working-title">
          準備中
        </h3>

        <p class="mb-0 now-working-text">
          現在準備中です。追加を楽しみにしてお待ちください
        </p>
      </div>

      <div class="d-flex justify-center px-8 py-12 py-md-4">
        <v-img
          alt="店舗外観写真は現在準備中"
          src="/s/now-working.jpg"
          max-width="300px"
        />
      </div>
    </template>

    <template v-else>
      <v-row>
        <v-col v-for="(image, key) in appearanceImageLinkRemovedNoImages" :key="key" cols="6" sm="4">
          <v-img
            :alt="`店舗写真(${key})`"
            :src="image"
          />
        </v-col>
      </v-row>
    </template>
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

  setup(props: Props) {
    const appearanceImageLinkRemovedNoImages = computed(() => {
      if (!props.shop.appearanceImageLink) {
        return []
      }

      return props.shop.appearanceImageLink.filter((image: string) => image !== '/no-image.png')
    })

    return {
      appearanceImageLinkRemovedNoImages
    }
  }
})
</script>

<style lang="scss" scoped>
.now-working-title {
  font-weight: bolder;
  font-size: 1.1rem;

  @include mq(md) {
    font-size: 1.2rem;
  }
}

.now-working-text {
  font-size: 0.9rem;

  @include mq(md) {
    font-size: 1rem;
  }
}
</style>
