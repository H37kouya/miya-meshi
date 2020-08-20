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
import { computed, defineComponent, onMounted, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { MetaInfo } from 'vue-meta'
import { MenuFormState } from '@/src/types/MenuFormState'
import { Shop, SHOP_TYPE } from '@/src/types/Shop'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { Menu, MENU_TYPE } from '@/src/types/Menu'
import { getMenuByID } from '@/src/infra/firestore/Menu'
import { getDishList } from '~/src/infra/firestore/Dish'
import { getKeywordList } from '~/src/infra/firestore/Keyword'
import { Dish } from '~/src/types/Dish'
import { Keyword } from '~/src/types/Keyword'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: { type: SHOP_TYPE } as Shop,
      menu: { type: MENU_TYPE } as Menu,
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
