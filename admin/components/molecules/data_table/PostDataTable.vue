<template>
  <v-data-table
    :headers="headers"
    :items="state.posts"
    class="elevation-1"
  >
    <template #item.release="{ item }">
      {{ item.now_public ? '公開' : '非公開' }}
    </template>
    <template #item.content_mode="{ item }">
      <span v-if="item.content_mode === ContentMode.NORMAL">通常</span>
      <span v-if="item.content_mode === ContentMode.NO_CONTENT">外部リンク</span>
      <span v-if="item.content_mode === ContentMode.ADVERTISING">広告</span>
    </template>
    <template #item.edit="{ item }">
      <v-btn :to="`/post/${item.id}/edit`" color="orange" dark>
        編集
      </v-btn>
    </template>
    <template #item.delete="{ item }">
      <DeleteConfirmButton text="削除" @click="onDelete(item.id)" />
    </template>
  </v-data-table>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Post } from '@/lib'
import { ContentMode } from '@/lib/enum/api/ContentMode'

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
      { text: '公開中かどうか', value: 'release' },
      { text: 'モード', value: 'content_mode' },
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
      ContentMode,
      headers
    }
  }
})
</script>
