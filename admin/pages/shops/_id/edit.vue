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
import { Dish, Shop, PriceRange, Keyword } from '@/lib'
import { editShop as editDBShop, getShopByID } from '@/src/infra/backend/Shop'
import { MetaInfo } from 'vue-meta'
import { formatShopAddress } from '@/src/utils/Shop'
import { getPriceRangeList } from '@/src/infra/firestore/PriceRange'
import { getDishList } from '@/src/infra/firestore/Dish'
import { getKeywordList } from '@/src/infra/firestore/Keyword'
import { DEFAULT_IMAGE } from '~/src/types/Menu'

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

      await editDBShop(context.root.$config.API_TOKEN, state.shop.id,  shop, context.root.$axios)

      return await context.root.$router.push('/shops')
    }

    watchEffect(async () => {
      const [dishes, shop, priceRangeList, keywords] = await Promise.all([
        getDishList(context.root.$fireStore),
        getShopByID(context.root.$route.params.id, context.root.$config.API_TOKEN, context.root.$axios),
        getPriceRangeList(context.root.$fireStore),
        getKeywordList(context.root.$fireStore)
      ])
      state.priceRangeList = priceRangeList
      state.dishes = dishes
      state.keywords = keywords

      if (!shop.appearance_image_link || shop.appearance_image_link.length !== 10) {
        const loop = shop.appearance_image_link
          ? 10 - shop.appearance_image_link.length
          : 10
        shop.appearance_image_link = shop.appearance_image_link || []
        for (let i = 0; i < loop; i++) {
          shop.appearance_image_link.push(DEFAULT_IMAGE)
        }
      }

      if (!shop.menu_image_link || shop.menu_image_link.length !== 6) {
        const loop = shop.menu_image_link
          ? 6 - shop.menu_image_link.length
          : 6
        shop.menu_image_link = shop.menu_image_link || []
        for (let i = 0; i < loop; i++) {
          shop.menu_image_link.push(DEFAULT_IMAGE)
        }
      }

      state.shop = shop
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
