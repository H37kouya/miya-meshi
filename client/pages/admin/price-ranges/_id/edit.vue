<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        価格帯編集
      </AdminMainText>

      <v-btn to="/admin/price-ranges" color="success">
        価格帯一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <PriceRangeForm :price-range="state.priceRange" @submit="editPriceRange" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { PriceRange } from '@/src/types/PriceRange'
import { getPriceRangeByID } from '@/src/infra/firestore/PriceRange'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      priceRange: {} as PriceRange
    })

    const editPriceRange = async (priceRange: any) => {
      await context.root.$fireStore.collection('priceRanges').doc(state.priceRange.id).update({
        ...removeUndefinedFromObject(priceRange),
        updatedAt: context.root.$fireStoreObj.FieldValue.serverTimestamp()
      })

      return await context.root.$router.push('/admin/price-ranges')
    }

    onMounted(async () => {
      state.priceRange = await getPriceRangeByID(context.root.$fireStore, context.root.$route.params.id)
    })

    return {
      state,
      editPriceRange
    }
  }
})
</script>
