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

      <v-btn :to="`/shops/${state.shop.id}`" class="ml-auto ml-sm-0 mt-4">
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
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { MetaInfo } from 'vue-meta'
import { MenuFormState } from '@/src/types/MenuFormState'
import { Dish, Keyword, Shop, Menu } from '@/lib'
import { getMenuByID, editMenu as editDBMenu } from '@/src/infra/backend/Menu'
import { getDishList } from '@/src/infra/firestore/Dish'
import { getKeywordList } from '@/src/infra/firestore/Keyword'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop,
      menu: {} as Menu,
      dishes: [] as Dish[],
      keywords: [] as Keyword[],
      shopId: computed(() => context.root.$route.params.id),
      shopMenuId: computed(() => context.root.$route.params.menuId),
    })

    const createMenu = async (menu: Menu) => {
      await editDBMenu(
        context.root.$config.API_TOKEN,
        menu,
        state.shopId,
        state.shopMenuId,
        context.root.$axios
      )

      return await context.root.$router.push(`/shops/${state.shopId}`)
    }

    watchEffect(async () => {
      const [shop, dishes, keywords] = await Promise.all([
        getMenuByID(
          state.shopId,
          state.shopMenuId,
          context.root.$config.API_TOKEN,
          context.root.$axios
        ),
        getDishList(context.root.$fireStore),
        getKeywordList(context.root.$fireStore)
      ])
      state.shop = shop
      state.menu = shop.shop_menu
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
