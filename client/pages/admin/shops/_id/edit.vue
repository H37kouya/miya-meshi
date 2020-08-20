<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        店舗編集
      </AdminMainText>

      <v-btn to="/admin/shops" color="purple lighten-4">
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
import { defineComponent, onMounted, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { ShopFormState } from '@/src/types/ShopFormState'
import { Shop, SHOP_TYPE } from '@/src/types/Shop'
import { editShop as editDBShop, getShopByID } from '@/src/infra/firestore/Shop'
import { MetaInfo } from 'vue-meta'
import { formatShopAddress } from '~/src/utils/Shop'
import { getPriceRangeList } from '~/src/infra/firestore/PriceRange'
import { PriceRange } from '~/src/types/PriceRange'
import { Dish } from '~/src/types/Dish'
import { getDishList } from '~/src/infra/firestore/Dish'
import { getKeywordList } from '~/src/infra/firestore/Keyword'
import { Keyword } from '~/src/types/Keyword'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      dishes: [] as Dish[],
      shop: { type: SHOP_TYPE } as Shop,
      keywords: [] as Keyword[],
      priceRangeList: [] as PriceRange[]
    })

    const editShop = async (shop: ShopFormState['shop']) => {
      shop.address = formatShopAddress(shop.address)

      await editDBShop(context.root.$fireStore, context.root.$fireStoreObj, shop, state.shop.id)

      return await context.root.$router.push('/admin/shops')
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
