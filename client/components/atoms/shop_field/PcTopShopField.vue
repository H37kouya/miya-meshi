<template>
  <div>
    <v-img
      :src="shop.imageLink"
      width="100%"
      aspect-ratio="1.6"
    />

    <div class="pt-2">
      <p class="mb-2 shop-description">
        {{ shop.description }}
      </p>

      <p class="mb-0 shop-intro">
        {{ shop.intro }}
      </p>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'
import { Shop } from '@/lib'

type Props = {
  shop: Shop
}

export default defineComponent({
  props: {
    shop: {
      type: Object,
      default: undefined
    }
  }
})
</script>

<style lang="scss" scoped>
.shop-description {
  font-size: 1.1rem;
  font-weight: bolder;
}

.shop-intro {
  font-size: 0.9rem;
}
</style>
