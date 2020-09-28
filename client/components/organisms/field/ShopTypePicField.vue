<template>
  <div>
    <ShopText :level="2">
      店舗写真
    </ShopText>

    <div class="text-center pt-4">
      <h3 class="now-working-title">
        準備中
      </h3>

      <p class="mb-0 now-working-text">
        完成を楽しみにしてお待ちください
      </p>
    </div>

    <div class="d-flex justify-center px-8 py-4">
      <v-img
        alt="現在準備中 - 完成をお待ちください"
        :src="$device.isMobileOrTablet ? '/s/now-working-mobile.png' : '/s/now-working.png'"
        max-width="300px"
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
