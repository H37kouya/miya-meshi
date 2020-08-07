<template>
  <v-container>
    <h1>Shop ページ</h1>

    <h2>ログイン済み</h2>

    <v-list>
      <template v-for="(shop, key) in state.shops">
        <v-list-item :key="key" :to="`/admin/shops/${shop.id}`">
          {{ shop.id }}: {{ shop.name }}
        </v-list-item>
      </template>
    </v-list>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, onMounted } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'

const getShopList = async (context: SetupContext) => {
  return await context.root.$fireStore.collection('shops').get()
}

const firestoreDocDataToShop = (doc: firebase.firestore.QueryDocumentSnapshot<firebase.firestore.DocumentData>) => {
  const docData = doc.data()
  return {
    id: doc.id,
    name: docData.name
  } as Shop
}

export default defineComponent({
  middleware: 'admin-auth',

  setup (props: any, context: SetupContext) {
    const state = reactive({
      shops: [] as Shop[]
    })

    onMounted(async () => {
      const shopList = await getShopList(context)
      shopList.forEach((shopDoc) => {
        state.shops.push(firestoreDocDataToShop(shopDoc))
      })
    })

    return {
      state
    }
  }
})
</script>
