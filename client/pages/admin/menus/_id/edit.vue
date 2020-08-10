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
          :menu="state.menu"
          @submit="createMenu"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { removeUndefinedFromObject } from '@/src/utils/Object'
import { MetaInfo } from 'vue-meta'
import { MenuFormState } from '@/src/types/MenuFormState'
import { Shop, SHOP_TYPE } from '@/src/types/Shop'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { Menu, MENU_TYPE } from '@/src/types/Menu'
import { getMenuByID } from '@/src/infra/firestore/Menu'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: { type: SHOP_TYPE } as Shop,
      menu: { type: MENU_TYPE } as Menu,
      id: computed(() => context.root.$route.params.id)
    })

    const createMenu = async (menus: MenuFormState['menu']) => {
      const addData = {
        shopID: state.menu.shopID,
        ...removeUndefinedFromObject(menus),
        createdAt: context.root.$fireStoreObj.FieldValue.serverTimestamp(),
        updatedAt: context.root.$fireStoreObj.FieldValue.serverTimestamp()
      } as firebase.firestore.DocumentData

      await context.root.$fireStore.collection('menus').add(addData)

      return await context.root.$router.push('/admin/shops')
    }

    onMounted(async () => {
      state.menu = await getMenuByID(context.root.$fireStore, state.id)
      state.shop = await getShopByID(context.root.$fireStore, state.menu.shopID)
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
