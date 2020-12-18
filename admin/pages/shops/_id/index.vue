<template>
  <v-container>
    <v-row>
      <AdminMainText>
        {{ state.shop.name }}
      </AdminMainText>
    </v-row>

    <v-row class="mt-4">
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
        <AdminMenuListCard :shopid="state.id" :menus="state.menus" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, onMounted, computed } from '@vue/composition-api'
import { Shop, Menu } from '@/lib'
import { deleteShop, getShopByID } from '@/src/infra/backend/Shop'
import { deleteMultipleMenu, getMenuListByShopID } from '@/src/infra/firestore/Menu'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop,
      menus: [] as Menu[],
      id: computed(() => context.root.$route.params.id)
    })

    onMounted(async () => {
      const shop = await getShopByID(state.id, context.root.$config.API_TOKEN, context.root.$axios)
      state.shop = shop
      state.menus = shop.shop_menus
    })

    const onDelete = async () => {
      await Promise.all([
        deleteShop(context.root.$config.API_TOKEN, state.id, context.root.$axios)
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
