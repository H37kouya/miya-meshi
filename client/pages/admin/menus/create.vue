<template>
  <v-container>
    <v-row class="mb-4" justify="space-between">
      <div>
        <AdminMainText>
          新規メニュー追加
        </AdminMainText>

        <AdminMainText class="mt-2" :level="2">
          {{ state.shop.name }}
        </AdminMainText>
      </div>

      <v-btn :to="`/admin/shops/${state.shop.id}`">
        店舗へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <MenuForm
          @submit="createMenu"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { MetaInfo } from 'vue-meta'
import { MenuFormState } from '@/src/types/MenuFormState'
import { Shop } from '@/src/types/Shop'
import { getShopByID } from '@/src/infra/firestore/Shop'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop
    })

    const shopID = context.root.$route.query.shopid as string|null

    if (!shopID || shopID === 'undefined') {
      return context.root.$nuxt.error({
        statusCode: 404
      })
    }

    const createMenu = async (menus: MenuFormState['menu']) => {
      const addData = {
        shopID,
        ...removeUndefinedFromObject(menus),
        createdAt: context.root.$fireStoreObj.FieldValue.serverTimestamp(),
        updatedAt: context.root.$fireStoreObj.FieldValue.serverTimestamp()
      } as firebase.firestore.DocumentData

      await context.root.$fireStore.collection('menus').add(addData)

      return await context.root.$router.push('/admin/shops')
    }

    onMounted(async () => {
      state.shop = await getShopByID(context.root.$fireStore, shopID)
    })

    return {
      state,
      createMenu
    }
  },

  head (): MetaInfo {
    return {
      title: '新規店舗作成'
    }
  }
})
</script>
