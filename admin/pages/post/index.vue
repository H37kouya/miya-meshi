<template>
  <v-container>
    <v-row class="mb-4" justify="space-between">
      <AdminMainText>
        ブログ一覧
      </AdminMainText>

      <div class="pt-4 pt-sm-0 ml-auto">
        <v-btn to="/post/create" color="success">
          ブログ追加
        </v-btn>
      </div>
    </v-row>

    <v-row>
      <v-col cols="12">
        <PostDataTable :keywords="state.posts" @delete="onDelete" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { Post } from '@/lib'
import { getSelectionPostList } from '@/src/infra/backend/SelectionPost'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_, context: SetupContext) {
    const state = reactive({
      posts: [] as Post[]
    })

    onMounted(async () => {
      state.posts = await getSelectionPostList(
        context.root.$config.API_URL,
        context.root.$config.API_TOKEN,
        context.root.$axios
      )
    })

    const onDelete = () => {}

    return {
      onDelete,
      state
    }
  }
})
</script>
