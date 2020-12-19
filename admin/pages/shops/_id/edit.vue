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
        type="edit"
        @submit="editShop"
      />
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { AxiosError } from 'axios'
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
      priceRangeList: [] as PriceRange[],
      errors: {} as any
    })

    const editShop = async (shop: any) => {
      try {
        shop.address = formatShopAddress(shop.address)

        await editDBShop(context.root.$config.API_TOKEN, state.shop.id,  shop, context.root.$axios)

        return await context.root.$router.push('/shops')
      } catch (_e) {
        const e = _e as AxiosError<any>

        if (e.response && e.response.status === 422) {
          state.errors = e.response.data
          return
        }

        console.error(e)
      }
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

      if (!shop.appearanceImageLink || shop.appearanceImageLink.length !== 10) {
        const loop = shop.appearanceImageLink
          ? 10 - shop.appearanceImageLink.length
          : 10
        shop.appearanceImageLink = shop.appearanceImageLink || []
        for (let i = 0; i < loop; i++) {
          shop.appearanceImageLink.push(DEFAULT_IMAGE)
        }
      }

      if (!shop.menuImageLink || shop.menuImageLink.length !== 6) {
        const loop = shop.menuImageLink
          ? 6 - shop.menuImageLink.length
          : 6
        shop.menuImageLink = shop.menuImageLink || []
        for (let i = 0; i < loop; i++) {
          shop.menuImageLink.push(DEFAULT_IMAGE)
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
