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

    <v-row>
      <v-col cols="12">
        <MenuListCard :menus="state.menus" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, onMounted, computed } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'
import { Menu } from '@/src/types/Menu'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { getMenuListByShopID } from '@/src/infra/firestore/Menu'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop,
      menus: [] as Menu[],
      id: computed(() => context.root.$route.params.id)
    })

    onMounted(async () => {
      state.shop = await getShopByID(context.root.$fireStore, state.id)
      state.menus = await getMenuListByShopID(context.root.$fireStore, state.id, 12, true)
    })

    return {
      state
    }
  }
})
</script>
