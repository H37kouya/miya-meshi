<template>
  <div>
    <div class="sns-background pt-6 px-2 pb-6">
      <div class="d-flex">
        <template v-for="(snsLink, key) in snsLinks">
          <v-btn
            :key="key"
            :href="snsLink.href"
            target="_blank"
            rel="noopener"
            icon
            x-large
            class="mx-2 mb-2"
          >
            <v-img :src="snsLink.src" :alt="snsLink.name" aspect-ratio="1" />
          </v-btn>
        </template>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'
import { SnsLink } from '@/src/utils/SnsLinks'

type Props = {
  snsLinks: SnsLink[]
}

export default defineComponent({
  props: {
    snsLinks: {
      type: Array,
      default: undefined
    }
  }
})
</script>

<style lang="scss" scoped>
.sns-background {
  background: $white;
}
</style>
