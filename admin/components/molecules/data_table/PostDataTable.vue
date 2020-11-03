<template>
  <v-data-table
    :headers="headers"
    :items="state.posts"
    class="elevation-1"
  >
    <template #item.edit="{ item }">
      <v-btn :to="`/post/${item.id}/edit`" color="orange" dark>
        編集する
      </v-btn>
    </template>
    <template #item.delete="{ item }">
      <DeleteConfirmButton @click="onDelete(item.id)" />
    </template>
  </v-data-table>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Post } from '@/lib'

type Props = {
  posts: Post[]
}
export default defineComponent({
  props: {
    posts: {
      type: Array,
      default: () => []
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      dialog: false,
      posts: [] as Post[]
    })

    const headers = [
      { text: '名前', value: 'title' },
      { text: '公開設定', value: 'release' },
      { text: '編集', value: 'edit', sortable: false },
      { text: '削除', value: 'delete', sortable: false }
    ]

    watch(() => props.posts, (newVal, _) => {
      state.posts = newVal
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
