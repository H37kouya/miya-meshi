<template>
  <BaseDetailTable :list="listItems" @click="onClick" />
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'
import { Dish } from '@/lib'
import { DetailListItemType } from '@/components/atoms/table/DetailListItemType'

type Props = {
  dishes: Dish[],
  selectedIds: string[]
}
export default defineComponent({
  props: {
    dishes: {
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
      return props.dishes.map((dish: Dish) => ({
        id: dish.id,
        selected: !!props.selectedIds.find((dID: string) => dish.id === dID),
        name: dish.name
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
