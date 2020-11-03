<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        ブログ編集
      </AdminMainText>

      <v-btn to="/post" color="success">
        ブログ一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <PostForm :post="state.post" @submit="editPost" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Post } from '@/lib'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { getSelectionPost, updateSelectionPost as updateDBPost } from '@/src/infra/backend/SelectionPost'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      post: {} as Post
    })

    const editPost = async (post: Post) => {
      updateDBPost(
        post,
        context.root.$config.API_URL,
        context.root.$config.API_TOKEN,
        context.root.$axios
      )

      return await context.root.$router.push('/post')
    }

    watchEffect(async () => {
      state.post = await getSelectionPost(
        Number(context.root.$route.params.id),
        context.root.$config.API_URL,
        context.root.$config.API_TOKEN,
        context.root.$axios
      )
    })

    return {
      state,
      editPost
    }
  }
})
</script>
