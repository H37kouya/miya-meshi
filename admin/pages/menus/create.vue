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

      <v-btn :to="`/shops/${state.shop.id}`">
        店舗へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <MenuForm
          :dishes="state.dishes"
          :keywords="state.keywords"
          @submit="createMenu"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { MetaInfo } from 'vue-meta'
import { MenuFormState } from '@/src/types/MenuFormState'
import { Dish, Keyword, Shop } from '@/lib'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { getDishList } from '@/src/infra/firestore/Dish'
import { getKeywordList } from '@/src/infra/firestore/Keyword'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop,
      dishes: [] as Dish[],
      keywords: [] as Keyword[]
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

      return await context.root.$router.push(`/shops/${shopID}`)
    }

    watchEffect(async () => {
      const [shop, dishes, keywords] = await Promise.all([
        getShopByID(context.root.$fireStore, shopID),
        getDishList(context.root.$fireStore),
        getKeywordList(context.root.$fireStore)
      ])
      state.shop = shop
      state.dishes = dishes
      state.keywords = keywords
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
