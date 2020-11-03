<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        新しいブログ追加
      </AdminMainText>

      <v-btn to="/blog" color="success">
        ブログ一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <PostForm @submit="createPost" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { createSelectionPost as createDBDPost } from '@/src/infra/backend/SelectionPost'
import { Post } from '@/lib'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const createPost = async (post: Post) => {
      await createDBDPost(
        {} as Post,
        context.root.$config.API_URL,
        context.root.$config.API_TOKEN,
        context.root.$axios
      )

      return await context.root.$router.push('/blog')
    }

    return {
      createPost
    }
  }
})
</script>
