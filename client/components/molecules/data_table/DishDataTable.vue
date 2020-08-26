<template>
  <v-data-table
    :headers="headers"
    :items="state.dishes"
    class="elevation-1"
  >
    <template v-slot:item.edit="{ item }">
      <v-btn :to="`/admin/dishes/${item.id}/edit`" color="orange" dark>
        編集する
      </v-btn>
    </template>
    <template v-slot:item.delete="{ item }">
      <DeleteConfirmButton @click="onDelete(item.id)" />
    </template>
  </v-data-table>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Dish } from 'miyameshi-lib'

type State = {
  dialog: boolean,
  dishes: Dish[]
}

type Props = {
  dishes: Dish[]
}
export default defineComponent({
  props: {
    dishes: {
      type: Array,
      default: () => []
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive<State>({
      dialog: false,
      dishes: [] as Dish[]
    })

    const headers = [
      { text: '名前', value: 'name' },
      { text: '優先度', value: 'priority' },
      { text: '編集', value: 'edit', sortable: false },
      { text: '削除', value: 'delete', sortable: false }
    ]

    watch(() => props.dishes, (newVal, _) => {
      state.dishes = newVal
    })

    const onDelete = (id: string) => context.emit('delete', id)

    return {
      onDelete,
      state,
      headers
    }
  }
})
</script>
