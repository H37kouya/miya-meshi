<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        新しいブログ追加
      </AdminMainText>

      <v-btn to="/post" color="success">
        ブログ一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <PostForm :areas="state.areas" :shops="state.shops" @submit="createPost" type="create" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { createSelectionPost as createDBDPost } from '@/src/infra/backend/SelectionPost'
import { Area, Post, Shop } from '@/lib'
import { getAreaList } from '~/src/infra/firestore/Area'
import { getShopList } from '~/src/infra/firestore/Shop'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      areas: [] as Area[],
      shops: [] as Shop[]
    })

    const createPost = async (post: Post) => {
      await createDBDPost(
        post,
        context.root.$config.API_URL,
        context.root.$config.API_TOKEN,
        context.root.$axios
      )

      return await context.root.$router.push('/post')
    }

    watchEffect(async () => {
      const [areas, shops] = await Promise.all([
        getAreaList(context.root.$fireStore),
        getShopList(context.root.$fireStore, 0)
      ])
      state.areas = areas
      state.shops = shops
    })

    return {
      createPost,
      state
    }
  }
})
</script>
