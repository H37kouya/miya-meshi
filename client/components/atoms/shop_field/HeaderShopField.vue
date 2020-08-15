<template>
  <div class="d-flex justify-center header-shop w-100 u-black--text">
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

        <h1 class="shop-heading">
          {{ name }}
        </h1>
      </div>

      <TelIconButton class="tel-pos" large />
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

.shop-prefix {
  color: #797979;
  font-size: 0.9rem;
  min-height: 1rem;
}

.shop-heading {
  color: #797979;
  font-size: 1.1rem;
  font-weight: 500;
}
</style>
