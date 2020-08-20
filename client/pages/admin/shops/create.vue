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
        :price-range-list="state.priceRangeList"
        @submit="createShop"
      />
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { ShopFormState } from '@/src/types/ShopFormState'
import { MetaInfo } from 'vue-meta'
import { createShop as createDBShop } from '@/src/infra/firestore/Shop'
import { formatShopAddress } from '@/src/utils/Shop'
import { PriceRange } from '@/src/types/PriceRange'
import { getPriceRangeList } from '@/src/infra/firestore/PriceRange'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      priceRangeList: [] as PriceRange[]
    })

    const createShop = async (shop: ShopFormState['shop']) => {
      await createDBShop(context.root.$fireStore, context.root.$fireStoreObj, shop)

      return await context.root.$router.push('/admin/shops')
    }

    onMounted(async () => {
      state.priceRangeList = await getPriceRangeList(context.root.$fireStore)
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
