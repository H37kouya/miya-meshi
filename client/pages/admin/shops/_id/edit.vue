<template>
  <v-container>
    <v-btn to="/admin/shops">
      Go To Shop List
    </v-btn>

    <v-row>
      <ShopForm
        :shop="state.shop"
        @submit="createShop"
      />
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { ShopFormState } from '@/src/types/ShopFormState'
import { Shop, SHOP_TYPE } from '@/src/types/Shop'

const getShop = async (context: SetupContext, id: string) => {
  return await context.root.$fireStore.collection('shops').doc(id).get()
}

const firestoreDocDataToShop = (
  doc: firebase.firestore.QueryDocumentSnapshot<firebase.firestore.DocumentData>|firebase.firestore.DocumentSnapshot<firebase.firestore.DocumentData>
) => {
  const docData = doc.data()

  return {
    type: SHOP_TYPE,
    id: doc.id,
    name: docData ? docData.name : undefined
  } as Shop
}

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: { type: SHOP_TYPE } as Shop
    })
    const fetchShop = async () => {
      const shopDoc = await getShop(context, context.root.$route.params.id)
      return firestoreDocDataToShop(shopDoc)
    }
    const createShop = async (shop: ShopFormState) => {
      await context.root.$fireStore.collection('shops').add({
        name: shop.name
      })

      return await context.root.$router.push('/admin/shops')
    }

    onMounted(async () => {
      state.shop = await fetchShop()
    })

    return {
      state,
      createShop
    }
  }
})
</script>
