<template>
  <v-card class="mt-4">
    <v-list two-line>
      <template v-for="(area, idx) in state.areas">
        <v-list-item :key="area.id" :to="`/area/${area.id}/edit`">
          <v-list-item-content>
            <v-list-item-title>
              {{ area.name }} ({{ area.addresses.length }})
            </v-list-item-title>
          </v-list-item-content>

          <v-list-item-action v-if="area.priority">
            {{ area.priority }}
          </v-list-item-action>
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
import { Area } from '@/lib'

type Props = {
  areas: Area[]
}

export default defineComponent({
  props: {
    areas: {
      type: Array,
      default: () => []
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
