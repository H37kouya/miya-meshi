<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        価格帯一覧
      </AdminMainText>

      <v-btn to="/admin/price-ranges/create" color="success">
        価格帯追加
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <PriceRangeDataTable :price-ranges="state.priceRanges" @delete="onDelete" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { PriceRange } from 'miyameshi-lib'
import { deletePriceRange, getPriceRangeList } from 'miyameshi-lib/src/infra/firestore/PriceRange'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_, context: SetupContext) {
    const state = reactive({
      priceRanges: [] as PriceRange[]
    })

    onMounted(async () => {
      state.priceRanges = await getPriceRangeList(context.root.$fireStore)
    })

    const onDelete = async (id: string) => {
      await deletePriceRange(context.root.$fireStore, id)

      state.priceRanges = state.priceRanges.filter(priceRange => priceRange.id !== id)
    }

    return {
      onDelete,
      state
    }
  }
})
</script>
