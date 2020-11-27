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
        <PostForm :areas="state.areas" :shops="state.shops" :post="state.post" @submit="editPost" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Area, Post, Shop } from '@/lib'
import { getSelectionPost, updateSelectionPost as updateDBPost } from '@/src/infra/backend/SelectionPost'
import { getAreaList } from '~/src/infra/firestore/Area'
import { getShopList } from '~/src/infra/firestore/Shop'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      areas: [] as Area[],
      post: {} as Post,
      shops: [] as Shop[]
    })

    const editPost = async (post: Post) => {
      updateDBPost(
        Number(context.root.$route.params.id),
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
