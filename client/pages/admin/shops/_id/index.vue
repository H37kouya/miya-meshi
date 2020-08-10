<template>
  <v-container>
    <v-row>
      <AdminMainText>
        {{ state.shop.name }}
      </AdminMainText>
    </v-row>

    <v-row justify="center" class="mt-4">
      <v-col cols="6" md="3">
        <CardButton
          to="/admin/shops"
          color="purple lighten-4"
          text="店舗一覧"
          text-color="grey"
          icon="mdi-home"
        />
      </v-col>

      <v-col cols="6" md="3">
        <CardButton
          :to="`/admin/shops/${state.id}/edit`"
          color="orange lighten-4"
          text="店舗編集"
          text-color="grey"
          icon="mdi-home"
        />
      </v-col>

      <v-col cols="6" md="3">
        <CardButton
          :to="`/admin/menus/create/?shopid=${state.id}`"
          color="green lighten-4"
          text="メニュー追加"
          text-color="grey"
          icon="mdi-home"
        />
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
import { getMenuList } from '@/src/infra/firestore/Menu'

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
      state.menus = await getMenuList(context.root.$fireStore)
    })

    return {
      state
    }
  }
})
</script>
