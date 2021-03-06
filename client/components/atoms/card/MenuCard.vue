<template>
  <div>
    <component :is="to ? `nuxt-link` : 'div'" :to="to" class="text-decoration-none">
      <v-card
        v-bind="$attrs"
        :href="to ? undefined : src"
        :target="to ? undefined : '_blank'"
        :rel="to ? undefined : 'noopener'"
        :flat="screenMd"
        :tile="screenMd"
      >
        <v-img :alt="alt" :src="src" :aspect-ratio="screenMd ? 1.5 : 1.2" />
      </v-card>

      <p class="mb-0 menu-name u-black--text max-text-height-2">
        {{ menu.name }}
      </p>

      <template v-if="menu.keywords && menu.keywords.length > 0">
        <p class="topic u-black--text mb-0">
          <v-icon small>
            mdi-information
          </v-icon>
          {{ menu.keywords[0] }}
        </p>
      </template>
      <div v-else style="height: 19.2px" />

      <p v-if="priceDisplay" class="price red--text mb-0">
        <v-icon color="#d4573c" small>
          mdi-currency-usd
        </v-icon>
        <span class="price-display">{{ priceDisplay }}</span> 円 ({{ menu.isTaxIncluded ? '税込' : '税抜' }})
      </p>
      <div v-else style="height: 19.2px" />
    </component>

    <div>
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
import { Menu } from '~/lib'

type Props = {
  alt: string,
  src: string,
  to: string,
  menu: Menu
}

export default defineComponent({
  props: {
    alt: {
      type: String,
      default: undefined
    },

    to: {
      type: [String, Object],
      default: undefined
    },

    src: {
      type: String,
      default: undefined
    },

    menu: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, _) {
    const priceDisplay = computed(() => props.menu.price ? props.menu.price.toLocaleString() : undefined)
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

.price, .topic {
  font-size: 0.8rem;
}

.price-display {
  font-weight: bolder;
  @include mq(md) {
    font-size: 1rem;
  }
}
</style>
