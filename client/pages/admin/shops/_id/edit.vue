<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        店舗編集
      </AdminMainText>

      <v-btn to="/admin/shops">
        店舗一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <ShopForm
        :shop="state.shop"
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

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: { type: SHOP_TYPE } as Shop,
      priceRangeList: [] as PriceRange[]
    })

    const editShop = async (shop: ShopFormState['shop']) => {
      shop.address = formatShopAddress(shop.address)

      await editDBShop(context.root.$fireStore, context.root.$fireStoreObj, shop, state.shop.id)

      return await context.root.$router.push('/admin/shops')
    }

    watchEffect(async () => {
      const [shop, priceRangeList] = await Promise.all([
        getShopByID(context.root.$fireStore, context.root.$route.params.id),
        getPriceRangeList(context.root.$fireStore)
      ])
      state.shop = shop
      state.priceRangeList = priceRangeList
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
