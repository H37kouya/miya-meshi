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
        @submit="editShop"
      />
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { ShopFormState } from '@/src/types/ShopFormState'
import { Shop, SHOP_TYPE } from '@/src/types/Shop'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { MetaInfo } from 'vue-meta'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: { type: SHOP_TYPE } as Shop
    })

    const editShop = async (shop: ShopFormState['shop']) => {
      await context.root.$fireStore.collection('shops').doc(state.shop.id).update({
        ...removeUndefinedFromObject(shop),
        updatedAt: context.root.$fireStoreObj.FieldValue.serverTimestamp()
      })

      return await context.root.$router.push('/admin/shops')
    }

    onMounted(async () => {
      state.shop = await getShopByID(context.root.$fireStore, context.root.$route.params.id)
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
