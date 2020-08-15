<template>
  <v-container>
    <v-row class="mb-4" justify="space-between">
      <AdminMainText>
        新規店舗追加
      </AdminMainText>

      <v-btn to="/admin/shops">
        Go To Shop List
      </v-btn>
    </v-row>

    <v-row>
      <ShopForm
        @submit="createShop"
      />
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { ShopFormState } from '@/src/types/ShopFormState'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { MetaInfo } from 'vue-meta'
import { createShop as createDBShop } from '@/src/infra/firestore/Shop'
import { formatShopAddress } from '@/src/utils/Shop'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const createShop = async (shop: ShopFormState['shop']) => {
      shop.address = formatShopAddress(shop.address)
      await createDBShop(context.root.$fireStore, context.root.$fireStoreObj, shop)

      return await context.root.$router.push('/admin/shops')
    }

    return {
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
