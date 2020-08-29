<template>
  <BaseDetailTable :list="listItems" @click="onClick" />
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { Area } from '@/lib'
import { DetailListItem } from '~/components/atoms/table/DetailListItemType'

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

  setup (props: Props, context: SetupContext) {
    const listItems = computed(() => {
      return props.areas.map((area: Area) => ({
        id: area.id,
        selected: !!props.selectedIds.find((aID: string) => area.id === aID),
        name: area.name
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
