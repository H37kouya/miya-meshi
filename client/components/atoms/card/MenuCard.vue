<template>
  <div>
    <component :is="to ? `nuxt-link` : 'div'" :to="to" class="text-decoration-none">
      <v-card v-bind="$attrs" :flat="screenMd" :tile="screenMd">
        <v-img :alt="alt" :src="src" :aspect-ratio="screenMd ? 1.5 : 1.2" />
      </v-card>

      <p class="mb-0 menu-name u-black--text max-text-height-2">
        {{ name }}
      </p>
      <p v-if="price" class="price red--text mb-0">
        <span class="price-display">{{ priceDisplay }}</span> 円 ({{ isTaxIncluded ? '税込' : '税抜' }})
      </p>
      <div v-else style="height: 19.2px" />
    </component>

    <div class="mt-2">
      <v-chip-group>
        <v-chip v-if="menu.canTakeout" small outlined>
          テイクアウト可
        </v-chip>
      </v-chip-group>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from '@nuxtjs/composition-api'
import { useGetScreenSize } from '@/src/CompositonFunctions/utils/UseGetScreenSize'

type Props = {
  alt: string,
  name: string,
  price: number,
  src: string,
  to: string,
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

    to: {
      type: [String, Object],
      default: undefined
    },

    src: {
      type: String,
      default: undefined
    },

    isTaxIncluded: {
      type: Boolean,
      default: false
    },

    menu: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, _) {
    const priceDisplay = computed(() => props.price.toLocaleString())
    const { screenMd } = useGetScreenSize()

    return {
      screenMd,
      priceDisplay
    }
  }
})
</script>

<style lang="scss" scoped>
.menu-name {
  font-size: 0.82rem;
  font-weight: bolder;
  height: 2.75rem;
  word-break: break-all;
}

.price {
  font-size: 0.8rem;
}

.price-display {
  font-weight: bolder;
  @include mq(md) {
    font-size: 1rem;
  }
}
</style>
