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
          :to="`/shops/${state.shop.id}`"
          color="orange lighten-4"
          text="店舗を見る"
          text-color="grey"
          icon="mdi-home"
        />
      </v-col>

      <v-col cols="6" md="3">
        <CardButton
          :to="`/menus/${state.id}/edit`"
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
  </v-container>
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { Shop, Menu, Enum } from '@/lib'
import { getShopByID } from '@/src/infra/firestore/Shop'
import { deleteMenu, getMenuByID } from '@/src/infra/firestore/Menu'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: { type: Enum.Type.SHOP } as Shop,
      menu: { type: Enum.Type.MENU } as Menu,
      id: computed(() => context.root.$route.params.id)
    })

    onMounted(async () => {
      state.menu = await getMenuByID(context.root.$fireStore, state.id)
      state.shop = await getShopByID(context.root.$fireStore, state.menu.shopID)
    })

    const onDelete = async () => {
      await deleteMenu(context.root.$fireStore, state.id)

      return context.root.$router.push(`/shops/${state.shop.id}`)
    }

    return {
      onDelete,
      state
    }
  }
})
</script>
