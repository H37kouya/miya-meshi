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
import { Shop, SHOP_TYPE } from '@/src/types/Shop'
import { Menu, MENU_TYPE } from '@/src/types/Menu'

const getShop = async (context: SetupContext, id: string) => {
  return await context.root.$fireStore.collection('shops').doc(id).get()
}

const getMenu = async (context: SetupContext, id: string) => {
  const { docs } = await context.root.$fireStore.collection('menus').where('shopID', '==', id).get()
  return docs
}

const firestoreDocDataToShop = (
  doc: firebase.firestore.QueryDocumentSnapshot|firebase.firestore.DocumentSnapshot
) => {
  const docData = doc.data()

  return {
    type: SHOP_TYPE,
    id: doc.id,
    ...docData
  } as Shop
}

const firestoreDocDataToMenus = (
  docs: firebase.firestore.QueryDocumentSnapshot<firebase.firestore.DocumentData>[]
) => {
  return docs.map((doc) => {
    const docData = doc.data()

    return {
      type: MENU_TYPE,
      id: doc.id,
      ...docData
    } as Menu
  })
}

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
      const shopDoc = await getShop(context, state.id)
      state.shop = firestoreDocDataToShop(shopDoc)

      const menuDoc = await getMenu(context, state.id)
      state.menus = firestoreDocDataToMenus(menuDoc)
    })

    return {
      state
    }
  }
})
</script>
