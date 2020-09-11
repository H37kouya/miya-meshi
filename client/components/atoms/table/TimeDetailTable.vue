<template>
  <BaseDetailTable :list="listItems" @click="onClick" />
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { Time } from '@/lib'
import { DetailListItemType } from '@/components/atoms/table/DetailListItemType'

type Props = {
  times: Time[],
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
      return props.times.map((time: Time) => ({
        id: time.id,
        selected: !!props.selectedTimes.find((t: string) => time.id === t),
        name: time.name
      }) as DetailListItemType)
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
