<template>
  <v-container>
    <v-row>
      <AdminMainText>
        {{ state.shop.name }}
      </AdminMainText>
    </v-row>

    <v-row justify="center" class="mt-4">
      <v-col cols="6" md="3">
        <ListShopAdminButton />
      </v-col>

      <v-col cols="6" md="3">
        <EditShopAdminButton :shopid="state.id" />
      </v-col>

      <v-col cols="6" md="3">
        <CreateMenuAdminButton :shopid="state.id" />
      </v-col>
    </v-row>

    <v-row justify="end">
      <v-col cols="4" sm="1">
        <DeleteConfirmButton text="店舗削除" @click="onDelete" />
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12">
        <AdminMenuListCard :shopid="state.shop.id" :menus="state.menus" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, onMounted, computed } from '@vue/composition-api'
import { Shop, Menu } from 'miyameshi-lib'
import { deleteShop, getShopByID } from 'miyameshi-lib/src/infra/firestore/Shop'
import { deleteMultipleMenu, getMenuListByShopID } from 'miyameshi-lib/src/infra/firestore/Menu'

export default defineComponent({
  middleware: 'admin-auth',



  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop,
      menus: [] as Menu[],
      id: computed(() => context.root.$route.params.id)
    })

    onMounted(async () => {
      const [shop, menus] = await Promise.all([
        getShopByID(context.root.$fireStore, state.id),
        getMenuListByShopID(context.root.$fireStore, state.id, 12, true)
      ])
      state.shop = shop
      state.menus = menus
    })

    const onDelete = async () => {
      const menuIDs = state.menus.map(menu => menu.id)
      await Promise.all([
        deleteMultipleMenu(context.root.$fireStore, menuIDs),
        deleteShop(context.root.$fireStore, state.id)
      ])

      await context.root.$router.push('/shops')
    }

    return {
      onDelete,
      state
    }
  }
})
</script>
