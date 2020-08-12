<template>
  <component :is="to ? `nuxt-link` : 'div'" :to="to" class="text-decoration-none">
    <v-card v-bind="$attrs">
      <v-img :alt="alt" :src="src" aspect-ratio="1.2" />
    </v-card>

    <p class="prefix u-black--text mb-0">
      {{ prefixName }}
    </p>
    <p class="mb-0 shop-name u-black--text">
      {{ name }}
    </p>
  </component>
</template>

<script lang="ts">
import { computed, defineComponent } from '@vue/composition-api'

type Props = {
  alt: string,
  name: string,
  prefixName: number,
  src: string,
  to: string,
}

export default defineComponent({
  props: {
    alt: {
      type: String,
      default: undefined
    },

    name: {
      type: String,
      default: undefined
    },

    prefixName: {
      type: Number,
      default: 0
    },

    to: {
      type: [String, Object],
      default: undefined
    },

    src: {
      type: String,
      default: undefined
    }
  },

  setup (props: Props, _) {
    const priceDisplay = computed(() => props.price.toLocaleString())

    return {
      priceDisplay
    }
  }
})
</script>

<style lang="scss">
.shop-name {
  font-size: 0.82rem;
  word-break: break-all;
  height: 2.75rem;
}

.prefix {
  font-size: 0.8rem;
}
</style>
