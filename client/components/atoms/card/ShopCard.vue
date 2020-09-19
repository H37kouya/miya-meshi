<template>
  <div>
    <component :is="to ? `nuxt-link` : 'div'" :to="to" class="text-decoration-none">
      <v-card v-bind="$attrs" :flat="screenMd">
        <v-img :alt="alt" :src="src" :aspect-ratio="screenMd ? 1.73 : 1.2" />
      </v-card>

      <p class="mb-0 shop-name u-black--text max-text-height-2">
        {{ name }}
      </p>

      <div class="explation">
        <p v-if="area" class="d-sm-none area mb-0 u-black--text">
          <v-icon color="#d4573c" small>
            mdi-map-marker
          </v-icon>

          {{ area }}
        </p>

        <p v-if="prefixName" class="prefix u-black--text mb-0">
          <v-icon small>
            mdi-food
          </v-icon>

          {{ prefixName }}
        </p>

        <p v-if="priceRange" class="area mb-0 u-black--text">
          <v-icon small>
            mdi-cash
          </v-icon>

          {{ priceRange }}
        </p>
      </div>
    </component>

    <div class="mt-2">
      <v-chip-group>
        <v-chip v-if="address" class="d-none d-sm-block" small outlined>
          {{ address }}
        </v-chip>

        <v-chip v-if="canTakeout" small outlined>
          テイクアウト可
        </v-chip>
      </v-chip-group>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import { useGetScreenSize } from '@/src/CompositonFunctions/utils/UseGetScreenSize'

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

    address: {
      type: String,
      default: undefined
    },

    area: {
      type: String,
      default: undefined
    },

    canTakeout: {
      type: Boolean,
      default: false
    },

    name: {
      type: String,
      default: undefined
    },

    prefixName: {
      type: String,
      default: undefined
    },

    priceRange: {
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
    }
  },

  setup () {
    const { screenMd } = useGetScreenSize()

    return { screenMd }
  }
})
</script>

<style lang="scss" scoped>
.shop-name {
  font-size: 0.9rem;
  word-break: break-all;
  height: 2.75rem;
}

.prefix {
  font-size: 0.8rem;
}

.no-prefix {
  &::before {
    content: ' ';
    padding: 0.5rem;
  }
}

.explation {
  height: 3.25rem;

  @include mq(sm) {
    height: 3rem;
  }
}

.area {
  font-size: 0.8rem;
}
</style>
