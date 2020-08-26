<template>
  <v-container>
    <v-row class="mb-4" justify="space-between">
      <div>
        <AdminMainText>
          メニュー編集
        </AdminMainText>

        <AdminMainText v-if="state.menu.name" class="mt-2" :level="2">
          {{ state.menu.name }}
        </AdminMainText>
      </div>

      <v-btn :to="`/admin/shops/${state.shop.id}`">
        店舗へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <MenuForm
          :dishes="state.dishes"
          :menu="state.menu"
          :keywords="state.keywords"
          @submit="createMenu"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { removeUndefinedFromObject } from 'miyameshi-lib/src/utils/Object'
import { MetaInfo } from 'vue-meta'
import { MenuFormState } from '@/src/types/MenuFormState'
import { Dish, Keyword, Shop, Enum, Menu } from 'miyameshi-lib'
import { getShopByID } from 'miyameshi-lib/src/infra/firestore/Shop'
import { getMenuByID } from 'miyameshi-lib/src/infra/firestore/Menu'
import { getDishList } from 'miyameshi-lib/src/infra/firestore/Dish'
import { getKeywordList } from 'miyameshi-lib/src/infra/firestore/Keyword'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: { type: Enum.Type.SHOP } as Shop,
      menu: { type: Enum.Type.MENU } as Menu,
      dishes: [] as Dish[],
      keywords: [] as Keyword[],
      id: computed(() => context.root.$route.params.id)
    })

    const createMenu = async (menu: MenuFormState['menu']) => {
      await context.root.$fireStore.collection('menus').doc(state.menu.id).update({
        ...removeUndefinedFromObject(menu),
        updatedAt: context.root.$fireStoreObj.FieldValue.serverTimestamp()
      })

      return await context.root.$router.push(`/admin/shops/${state.menu.shopID}`)
    }

    watchEffect(async () => {
      state.menu = await getMenuByID(context.root.$fireStore, state.id)
      const [shop, dishes, keywords] = await Promise.all([
        getShopByID(context.root.$fireStore, state.menu.shopID),
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
      title: 'メニュー編集'
    }
  }
})
</script>
