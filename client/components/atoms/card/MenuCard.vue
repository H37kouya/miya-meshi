<template>
  <div>
    <v-card v-bind="$attrs">
      <v-img :alt="alt" :src="src" />
    </v-card>

    <p class="mb-0 menu-name u-black--text">
      {{ name }}
    </p>
    <p class="price red--text mb-0">
      {{ priceDisplay }} 円 ({{ isTaxIncluded ? '税込' : '税抜' }})
    </p>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from '@vue/composition-api'

type Props = {
  alt: string,
  name: string,
  price: number,
  src: string,
  isTaxIncluded: boolean
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

    price: {
      type: Number,
      default: 0
    },

    src: {
      type: String,
      default: undefined
    },

    isTaxIncluded: {
      type: Boolean,
      default: false
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
.menu-name {
  font-size: 0.9rem;
}

.price {
  font-size: 0.8rem;
}
</style>