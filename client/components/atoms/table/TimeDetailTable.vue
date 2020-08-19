<template>
  <v-container class="max-width-480">
    <v-row justify="center" no-gutters class="keyword-row">
      <template v-for="(time, key) in times">
        <v-col
          :key="key"
          :class="{ 'selected': selectedTimes.find((name) => time === name ) }"
          cols="4"
          class="px-0 py-2 text-center keyword-box"
          @click="onClick(time)"
        >
          {{ time }}
        </v-col>
      </template>
    </v-row>

    <p class="mb-0 text-right">
      <a href="https://forms.gle/Yq6x8vKnaKKPYX6eA" target="_blank" rel="noopener" class="other-keyword">
        もし求めてるキーワードがなかったら
      </a>
    </p>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'

type Props = {
  times: string[],
  selectedTimes: string[]
}
export default defineComponent({
  props: {
    times: {
      type: Array,
      default: () => []
    },

    selectedTimes: {
      type: Array,
      default: () => []
    }
  },

  setup (_, context: SetupContext) {
    const onClick = (time: string) => {
      return context.emit('click', time)
    }

    return {
      onClick
    }
  }
})
</script>

<style lang="scss" scoped>
@import "detail_table";
</style>
