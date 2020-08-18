<template>
  <div class="u-light-grey-background d-flex justify-center py-4">
    <div class="max-width-480 d-flex justify-center align-center px-4">
      <v-img src="/miyameshi-mogumogu.png" max-width="45px" height="60px" class="mr-2" />

      <v-card width="100%" height="80px" rounded="lg" class="d-flex align-center">
        <v-card-text class="pa-2 max-text-height-3">
          {{ description }}
        </v-card-text>
      </v-card>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'

type Props = {
  description: string
}
export default defineComponent({
  props: {
    description: {
      type: String,
      required: true
    }
  }
})
</script>
