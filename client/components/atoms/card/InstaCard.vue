<template>
  <component :is="to ? `nuxt-link` : 'div'" :to="to" class="text-decoration-none">
    <v-card v-bind="$attrs" class="pos-relative">
      <v-img :alt="alt" :src="src" aspect-ratio="1.2" />

      <template v-if="instaNumber">
        <div class="triangle" />
        <div class="triangle-text">
          <p class="mb-0 triangle-prefix">
            No.
          </p>
          <p class="mb-0 triangle-number">
            {{ displayNumber }}
          </p>
        </div>
      </template>
    </v-card>

    <p class="prefix u-black--text mb-0" :class="{ 'no-prefix': !prefixName }">
      {{ prefixName }}
    </p>
    <p class="mb-0 shop-name u-black--text max-text-height-2">
      {{ name }}
    </p>
  </component>
</template>

<script lang="ts">
import { computed, defineComponent } from '@vue/composition-api'
import { zeroFill } from '~/src/utils/String'

type Props = {
  alt: string,
  instaNumber: number,
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

    instaNumber: {
      type: Number,
      default: undefined
    },

    name: {
      type: String,
      default: undefined
    },

    prefixName: {
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

  setup (props: Props, _) {
    const displayNumber = computed(() => zeroFill(props.instaNumber))

    return {
      displayNumber
    }
  }
})
</script>

<style lang="scss">
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

.triangle {
  position: absolute;
  top: 0;
  left: 0;
  border-left: 50px solid #fef552;
  border-bottom: 50px solid transparent;
}

.triangle-text {
  position: absolute;
  top: 0;
  left: 0;
}

.triangle-prefix {
  font-size: 0.7rem;
  line-height: 1.1;
  padding-left: 1px;
}

.triangle-number {
  font-size: 0.95rem;
  font-weight: 500;
  line-height: 1.1;
  margin-top: -0.15rem;
}
</style>
