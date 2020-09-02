<template>
  <v-container>
    <v-row class="mb-4" justify="space-between">
      <AdminMainText>
        キーワード一覧
      </AdminMainText>

      <div class="pt-4 pt-sm-0 ml-auto">
        <v-btn to="/keywords/create" color="success">
          キーワード追加
        </v-btn>
      </div>
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
import { Keyword } from '@/lib'
import { deleteKeyword, getKeywordList } from '@/src/infra/firestore/Keyword'

export default defineComponent({
  middleware: 'admin-auth',

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
