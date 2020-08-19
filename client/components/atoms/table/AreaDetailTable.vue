<template>
  <v-container class="max-width-480">
    <v-row no-gutters class="keyword-row">
      <template v-for="area in areas">
        <v-col
          :key="area.id"
          :class="{ 'selected': selectedIds.find((aID) => area.id === aID ) }"
          cols="4"
          class="px-0 py-2 text-center keyword-box"
          @click="onClick(area.id)"
        >
          {{ area.name }}
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
import { Area } from '~/src/types/Area'

type Props = {
  areas: Area[],
  selectedIds: string[]
}
export default defineComponent({
  props: {
    areas: {
      type: Array,
      default: () => []
    },

    selectedIds: {
      type: Array,
      default: () => []
    }
  },

  setup (_, context: SetupContext) {
    const onClick = (id: string) => {
      return context.emit('click', id)
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
