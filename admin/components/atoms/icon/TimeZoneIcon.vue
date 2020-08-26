<template>
  <BaseIcon
    v-bind="$attrs"
    :selected="!!selected"
    :icon="icon"
    text="時間帯"
    v-on="$listeners"
  />
</template>

<script lang="ts">
import { computed, defineComponent } from '@vue/composition-api'
import { TimeZone } from '@/src/CompositonFunctions/btnStatus/UseBtnStatus'

type Props = {
  selected: TimeZone
}
export default defineComponent({
  props: {
    selected: {
      type: [Boolean, String],
      default: false
    }
  },

  setup (props: Props, _) {
    const icon = computed(() => {
      if (!props.selected) {
        return 'mdi-clock-outline'
      }

      if (props.selected === 'lunch') {
        return 'mdi-weather-sunny'
      }

      return 'mdi-weather-night-partly-cloudy'
    })

    return {
      icon
    }
  }
})
</script>
