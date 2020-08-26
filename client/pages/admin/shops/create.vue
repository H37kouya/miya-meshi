<template>
  <v-container>
    <v-row class="mb-4" justify="space-between">
      <AdminMainText>
        新規店舗追加
      </AdminMainText>

      <v-btn to="/admin/shops" class="ml-auto ml-sm-0 mt-4 mt-sm-0" color="purple lighten-4">
        店舗一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <ShopForm
        :dishes="state.dishes"
        :price-range-list="state.priceRangeList"
        @submit="createShop"
      />
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { ShopFormState } from '@/src/types/ShopFormState'
import { MetaInfo } from 'vue-meta'
import { createShop as createDBShop } from 'miyameshi-lib/src/infra/firestore/Shop'
import { Dish, PriceRange, Keyword } from 'miyameshi-lib'
import { getPriceRangeList } from 'miyameshi-lib/src/infra/firestore/PriceRange'
import { getDishList } from 'miyameshi-lib/src/infra/firestore/Dish'
import { getKeywordList } from 'miyameshi-lib/src/infra/firestore/Keyword'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      dishes: [] as Dish[],
      keywords: [] as Keyword[],
      priceRangeList: [] as PriceRange[]
    })

    const createShop = async (shop: any) => {
      await createDBShop(context.root.$fireStore, context.root.$fireStoreObj, shop)

      return await context.root.$router.push('/admin/shops')
    }

    watchEffect(async () => {
      const [dishes, priceRange, keywords] = await Promise.all([
        getDishList(context.root.$fireStore),
        getPriceRangeList(context.root.$fireStore),
        getKeywordList(context.root.$fireStore)
      ])

      state.dishes = dishes
      state.priceRangeList = priceRange
      state.keywords = keywords
    })

    return {
      state,
      createShop
    }
  },

  head (): MetaInfo {
    return {
      title: '新規店舗作成'
    }
  }
})
</script>
