<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        キーワード追加
      </AdminMainText>

      <v-btn to="/keywords" color="success">
        キーワード一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <KeywordForm @submit="createKeyword" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { removeUndefinedFromObject } from '@/src'/utils/Object'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const createKeyword = async (keyword: any) => {
      const addData = {
        ...removeUndefinedFromObject(keyword),
        createdAt: context.root.$fireStoreObj.FieldValue.serverTimestamp(),
        updatedAt: context.root.$fireStoreObj.FieldValue.serverTimestamp()
      } as firebase.firestore.DocumentData

      await context.root.$fireStore.collection('keywords').add(addData)

      return await context.root.$router.push('/keywords')
    }

    return {
      createKeyword
    }
  }
})
</script>
