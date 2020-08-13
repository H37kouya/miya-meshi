<template>
  <div class="d-flex justify-center header-shop w-100">
    <div class="pos-relative header-shop-wrapper">
      <v-img
        :src="src"
        width="480px"
        max-width="100%"
        aspect-ratio="1.78"
      />

      <div class="pl-4">
        <p>{{ prefixName }}</p>

        <h1 class="shop-heading">
          {{ name }}
        </h1>
      </div>

      <TelIcon class="tel-pos" large />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'

export default defineComponent({
  props: {
    src: {
      type: String,
      default: '/no-image.png'
    },

    prefixName: {
      type: String,
      default: undefined
    },

    name: {
      type: String,
      default: undefined
    }
  }
})
</script>

<style lang="scss" scoped>
.tel-pos {
  position: absolute;
  bottom: 0;
  right: 1rem;
  transform: translateY(-45%);
}

.header-shop {
  max-width: 100%;
}

.header-shop-wrapper {
  width: 480px;
  max-width: 100%;
}

.shop-heading {
  font-size: 1rem;
  font-weight: 500;
}
</style>
