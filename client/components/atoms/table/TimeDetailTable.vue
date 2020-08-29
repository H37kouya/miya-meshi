<template>
  <BaseDetailTable :list="listItems" @click="onClick" />
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { DetailListItem } from '~/components/atoms/table/DetailListItemType'

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

  setup (props: Props, context: SetupContext) {
    const listItems = computed(() => {
      return props.times.map((time: string) => ({
        id: time,
        selected: !!props.selectedTimes.find((t: string) => time === t),
        name: time
      }) as DetailListItem)
    })

    const onClick = (id: string) => {
      return context.emit('click', id)
    }

    return {
      listItems,
      onClick
    }
  }
})
</script>
