<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        店舗編集
      </AdminMainText>

      <v-btn to="/shops" color="purple lighten-4">
        店舗一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <ShopForm
        :dishes="state.dishes"
        :shop="state.shop"
        :keywords="state.keywords"
        :price-range-list="state.priceRangeList"
        @submit="editShop"
      />
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Dish, Shop, PriceRange, Keyword, Enum } from 'miyameshi-lib'
import { editShop as editDBShop, getShopByID } from 'miyameshi-lib/src/infra/firestore/Shop'
import { MetaInfo } from 'vue-meta'
import { formatShopAddress } from 'miyameshi-lib/src/utils/Shop'
import { getPriceRangeList } from 'miyameshi-lib/src/infra/firestore/PriceRange'
import { getDishList } from 'miyameshi-lib/src/infra/firestore/Dish'
import { getKeywordList } from 'miyameshi-lib/src/infra/firestore/Keyword'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      dishes: [] as Dish[],
      shop: { } as Shop,
      keywords: [] as Keyword[],
      priceRangeList: [] as PriceRange[]
    })

    const editShop = async (shop: any) => {
      shop.address = formatShopAddress(shop.address)

      await editDBShop(context.root.$fireStore, context.root.$fireStoreObj, shop, state.shop.id)

      return await context.root.$router.push('/shops')
    }

    watchEffect(async () => {
      const [dishes, shop, priceRangeList, keywords] = await Promise.all([
        getDishList(context.root.$fireStore),
        getShopByID(context.root.$fireStore, context.root.$route.params.id),
        getPriceRangeList(context.root.$fireStore),
        getKeywordList(context.root.$fireStore)
      ])
      state.shop = shop
      state.priceRangeList = priceRangeList
      state.dishes = dishes
      state.keywords = keywords
    })

    return {
      state,
      editShop
    }
  },

  head (): MetaInfo {
    return {
      title: '店舗編集'
    }
  }
})
</script>
