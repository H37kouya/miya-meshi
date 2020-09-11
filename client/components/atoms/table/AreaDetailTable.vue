<template>
  <BaseDetailTable :list="listItems" @click="onClick" />
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { Area } from '@/lib'
import { DetailListItemType, DETAIL_LIST_ITEM, DETAIL_LIST_ITEM_LANG } from '@/components/atoms/table/DetailListItemType'

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
      return [
        {
          id: DETAIL_LIST_ITEM.ALL,
          // 配列が空の時、「すべて」を表示する
          selected: props.selectedIds.length === 0,
          name: DETAIL_LIST_ITEM_LANG.ALL
        } as DetailListItemType,
        ...props.areas.map((area: Area) => ({
          id: area.id,
          selected: !!props.selectedIds.find((aID: string) => area.id === aID),
          name: area.name
        }) as DetailListItemType)
      ]
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
