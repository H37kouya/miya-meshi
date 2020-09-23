<template>
  <div class="u-light-grey-background">
    <v-container>
      <div class="d-flex justify-center">
        <template v-if="src.length === 1">
          <v-card
            :href="src[0]"
            target="_blank"
            rel="noopener"
          >
            <v-img
              :src="src[0]"
              max-width="480px"
              width="100%"
            />
          </v-card>
        </template>

        <template v-else>
          <v-carousel>
            <v-carousel-item
              v-for="(_src, key) in src"
              :key="key"
              :src="_src"
              reverse-transition="fade-transition"
              transition="fade-transition"
            />
          </v-carousel>
        </template>
      </div>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'

type Props = {
  src: string[]
}
export default defineComponent({
  props: {
    src: {
      type: Array,
      required: true
    }
  }
})
</script>
