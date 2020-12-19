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

      <v-btn :to="`/shops/${state.shopId}`">
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
import { AxiosError } from 'axios'
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { MetaInfo } from 'vue-meta'
import { MenuFormState } from '@/src/types/MenuFormState'
import { Dish, Keyword, Menu, Shop } from '@/lib'
import { getShopByID } from '@/src/infra/backend/Shop'
import { createMenu as createDBMenu } from '@/src/infra/backend/Menu'
import { getDishList } from '@/src/infra/firestore/Dish'
import { getKeywordList } from '@/src/infra/firestore/Keyword'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop,
      dishes: [] as Dish[],
      keywords: [] as Keyword[],
      shopID: computed(() => context.root.$route.params.id),
      errors: {}
    })

    const createMenu = async (menu: Menu) => {
      try {
        await createDBMenu(menu, state.shopID, context.root.$config.API_TOKEN, context.root.$axios)

        return await context.root.$router.push(`/shops/${state.shopID}`)
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
      const [shop, dishes, keywords] = await Promise.all([
        getShopByID(state.shopID, context.root.$config.API_TOKEN, context.root.$axios),
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
