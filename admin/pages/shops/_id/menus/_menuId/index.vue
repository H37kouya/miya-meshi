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

    <v-row class="mt-4">
      <v-col v-if="state.shop.id" cols="6" md="3">
        <CardButton
          :to="`/shops/${state.shopId}`"
          color="orange lighten-4"
          text="店舗を見る"
          text-color="grey"
          icon="mdi-home"
        />
      </v-col>

      <v-col cols="6" md="3">
        <CardButton
          :to="`/shops/${state.shopId}/menus/${state.shopMenuId}/edit`"
          color="green lighten-4"
          text="メニュー編集"
          text-color="grey"
          icon="mdi-home"
        />
      </v-col>
    </v-row>

    <v-row justify="end">
      <v-col cols="4" sm="1">
        <DeleteConfirmButton @click="onDelete" />
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" md="4">
        <v-card v-if="state.menu.image">
          <v-img :src="state.menu.image" />
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Shop, Menu, Enum } from '@/lib'
import { deleteMenu, getMenuByID } from '@/src/infra/backend/Menu'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: { type: Enum.Type.SHOP } as Shop,
      menu: { type: Enum.Type.MENU } as Menu,
      shopId: computed(() => context.root.$route.params.id),
      shopMenuId: computed(() => context.root.$route.params.menuId),
    })

    watchEffect(async () => {
      const shop = await getMenuByID(
        state.shopId,
        state.shopMenuId,
        context.root.$config.API_TOKEN,
        context.root.$axios
      )
      state.shop = shop
      state.menu = shop.shopMenu
    })

    const onDelete = async () => {
      await deleteMenu(
        context.root.$config.API_TOKEN,
        state.shopId,
        state.shopMenuId,
        context.root.$axios
      )

      return context.root.$router.push(`/shops/${state.shop.id}`)
    }

    return {
      onDelete,
      state
    }
  }
})
</script>
