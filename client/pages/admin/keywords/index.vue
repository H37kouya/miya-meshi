<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        キーワード一覧
      </AdminMainText>

      <v-btn to="/admin/keywords/create" color="success">
        キーワード追加
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <KeywordDataTable :keywords="state.keywords" @delete="onDelete" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { Keyword } from '@/src/types/Keyword'
import { deleteKeyword, getKeywordList } from '@/src/infra/firestore/Keyword'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_, context: SetupContext) {
    const state = reactive({
      keywords: [] as Keyword[]
    })

    onMounted(async () => {
      state.keywords = await getKeywordList(context.root.$fireStore)
    })

    const onDelete = async (id: string) => {
      await deleteKeyword(context.root.$fireStore, id)

      state.keywords = state.keywords.filter(keyword => keyword.id !== id)
    }

    return {
      onDelete,
      state
    }
  }
})
</script>
