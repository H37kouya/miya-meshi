<template>
  <component :is="to ? `nuxt-link` : 'div'" :to="to" class="text-decoration-none">
    <v-card v-bind="$attrs" class="pos-relative" :flat="screenMd">
      <v-img :alt="alt" :src="src" :aspect-ratio="screenMd ? 1.73 : 1.2" />

      <template v-if="instaNumber">
        <div class="insta-number-container">
          <p class="mb-0 insta-text">
            No. <span class="insta-number">{{ displayNumber }}</span>
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

    <div class="d-none d-sm-block">
      <v-chip v-if="area" small outlined>
        {{ area }}
      </v-chip>
    </div>
  </component>
</template>

<script lang="ts">
import { computed, defineComponent } from '@nuxtjs/composition-api'
import { zeroFill } from '@/src/utils/String'
import { useGetScreenSize } from '@/src/CompositonFunctions/utils/UseGetScreenSize'

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

    area: {
      type: String,
      default: undefined
    },

    address: {
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
    const { screenMd } = useGetScreenSize()

    return {
      displayNumber,
      screenMd
    }
  }
})
</script>

<style lang="scss" scoped>
.shop-name {
  font-size: 0.9rem;
  font-weight: bolder;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
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

.insta-number-container {
  position: absolute;
  top: 0.5rem;
  right: 0.5rem;
}

.insta-text {
  background: rgba(#000, 60%);
  border-radius: 4px;
  color: #fff;
  font-size: 0.7rem;
  line-height: 1.1;
  padding: 0.25rem 0.5rem;

  @include mq(md) {
    border-radius: 1px;
  }
}

.insta-number {
  font-size: 0.95rem;
  font-weight: 500;
}
</style>
