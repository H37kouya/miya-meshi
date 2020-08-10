<template>
  <v-container>
    <v-row>
      <div>
        <AdminMainText>
          メニューを見る
        </AdminMainText>

        <AdminMainText v-if="state.menu.name" :level="2">
          {{ state.menu.name }}
        </AdminMainText>
      </div>
    </v-row>

    <v-row justify="center" class="mt-4">
      <v-col v-if="state.shop.id" cols="6" md="3">
        <CardButton
          :to="`/admin/shops/${state.shop.id}`"
          color="orange lighten-4"
          text="店舗を見る"
          text-color="grey"
          icon="mdi-home"
        />
      </v-col>

      <v-col cols="6" md="3">
        <CardButton
          :to="`/admin/menus/${state.id}/edit`"
          color="green lighten-4"
          text="メニュー編集"
          text-color="grey"
          icon="mdi-home"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { Shop, SHOP_TYPE } from '@/src/types/Shop'
import { Menu, MENU_TYPE } from '@/src/types/Menu'
import { getShopByID } from '@/src/infra/firestore/Shop'
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

    onMounted(async () => {
      state.menu = await getMenuByID(context.root.$fireStore, state.id)
      state.shop = await getShopByID(context.root.$fireStore, state.menu.shopID)
    })

    return {
      state
    }
  }
})
</script>
