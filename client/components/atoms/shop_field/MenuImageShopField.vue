<template>
  <div class="u-light-grey-background">
    <v-container>
      <div class="d-flex justify-center">
        <v-card
          :href="src"
          target="_blank"
          rel="noopener"
        >
          <v-img
            :src="src"
            max-width="480px"
            width="100%"
          />
        </v-card>
      </div>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'

type Props = {
  src: string
}
export default defineComponent({
  props: {
    src: {
      type: String,
      required: true
    }
  }
})
</script>
