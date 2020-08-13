<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        キーワード追加
      </AdminMainText>

      <v-btn to="/admin/keywords" color="success">
        キーワード一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <KeywordForm :keyword="state.keyword" @submit="editKeyword" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { Keyword } from '@/src/types/Keyword'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { getKeywordByID } from '@/src/infra/firestore/Keyword'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      keyword: {} as Keyword
    })

    const editKeyword = async (keyword: any) => {
      await context.root.$fireStore.collection('keywords').doc(state.keyword.id).update({
        ...removeUndefinedFromObject(keyword),
        updatedAt: context.root.$fireStoreObj.FieldValue.serverTimestamp()
      })

      return await context.root.$router.push('/admin/keywords')
    }

    onMounted(async () => {
      state.keyword = await getKeywordByID(context.root.$fireStore, context.root.$route.params.id)
    })

    return {
      state,
      editKeyword
    }
  }
})
</script>
