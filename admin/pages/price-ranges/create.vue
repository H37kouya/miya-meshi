<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        価格帯追加
      </AdminMainText>

      <v-btn to="/price-ranges" color="success">
        価格帯一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <PriceRangeForm @submit="createPriceRange" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { removeUndefinedFromObject } from 'miyameshi-lib/src/utils/Object'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const createPriceRange = async (priceRanges: any) => {
      const addData = {
        ...removeUndefinedFromObject(priceRanges),
        createdAt: context.root.$fireStoreObj.FieldValue.serverTimestamp(),
        updatedAt: context.root.$fireStoreObj.FieldValue.serverTimestamp()
      } as firebase.firestore.DocumentData

      await context.root.$fireStore.collection('priceRanges').add(addData)

      return await context.root.$router.push('/price-ranges')
    }

    return {
      createPriceRange
    }
  }
})
</script>
