<template>
  <v-container class="py-0 max-width-480">
    <v-row justify="center">
      <v-col cols="3" class="px-2">
        <TakeoutIcon selected />
      </v-col>

      <v-col cols="3" class="px-2">
        <OpenBuzIcon />
      </v-col>

      <v-col cols="3" class="px-2">
        <NowLocationIcon />
      </v-col>

      <v-col cols="3" class="px-2">
        <AreaIcon />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'

type Props = {
  takeout: boolean,
  openBuz: boolean,
  nowLocation: boolean,
  area: boolean
}

export default defineComponent({

})
</script>
