<template>
  <v-card class="mt-4">
    <v-list two-line>
      <template v-for="(area, idx) in state.areas">
        <v-list-item :key="area.id" :to="`/admin/area/${area.id}/edit`">
          <v-list-item-content>
            <v-list-item-title>
              {{ area.name }} ({{ area.addresses.length }})
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider
          v-if="idx + 1 < state.areas.length"
          :key="idx"
        />
      </template>
    </v-list>
  </v-card>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { isShop } from '@/src/utils/Shop'
import { Shop } from '@/src/types/Shop'
import { Area } from '@/src/types/Area'

type Props = {
  areas: Area[]
}

export default defineComponent({
  props: {
    areas: {
      type: Array,
      validator (arr: any[]): arr is Shop[] {
        return arr.every(v => isShop(v))
      }
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      areas: props.areas as Area[]
    })

    watch(() => props.areas, (newVal, _) => {
      state.areas = newVal
    })

    return {
      state
    }
  }
})
</script>
