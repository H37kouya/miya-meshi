<template>
  <div class="d-flex justify-center header-shop w-100">
    <div class="pos-relative header-shop-wrapper">
      <a :href="src" target="_blank" rel="noopener">
        <v-img
          :src="src"
          width="480px"
          max-width="100%"
          aspect-ratio="1.78"
        >
          <template #placeholder>
            <v-row
              class="fill-height ma-0"
              align="center"
              justify="center"
            >
              <v-progress-circular indeterminate color="grey lighten-5" />
            </v-row>
          </template>
        </v-img>
      </a>

      <div class="pl-4 py-2">
        <p class="mb-0 shop-prefix">
          {{ prefixName }}
        </p>

        <h1 class="shop-heading max-text-height-1">
          {{ name }}
        </h1>
      </div>

      <TelIconButton class="tel-pos" large />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'

type Props = {
  src: string,
  prefixName: string,
  name: string
}
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
  right: 2.5rem;
  transform: translateY(-45%);
}

.header-shop {
  max-width: 100%;
}

.header-shop-wrapper {
  width: 480px;
  max-width: 100%;
}

.shop-prefix {
  font-size: 0.9rem;
  min-height: 1rem;
}

.shop-heading {
  font-size: 1.25rem;
  font-weight: 500;
}
</style>
