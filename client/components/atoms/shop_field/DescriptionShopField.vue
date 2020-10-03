<template>
  <div class="u-light-grey-background d-flex justify-center pt-4 pb-2 border-b border-dark-gray">
    <div class="max-width-480 d-flex justify-center align-center px-4">
      <v-img src="/s/miyameshi-mogumogu.png" max-width="45px" height="60px" class="mr-2" />

      <v-card width="100%" height="80px" rounded="lg" class="d-flex align-center">
        <v-card-text class="pa-2 max-text-height-3 description-text">
          {{ description }}
        </v-card-text>
      </v-card>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'

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

<style lang="scss" scoped>
.description-text {
  color: $u-black !important;
}
</style>
