<template>
  <v-container>
    <v-btn to="/admin/shops">
      Go To Shop List
    </v-btn>

    <div>
      {{ state.shop.id }}
      {{ state.shop.name }}
    </div>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, onMounted } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'

const getShop = async (context: SetupContext, id: string) => {
  return await context.root.$fireStore.collection('shops').doc(id).get()
}

const firestoreDocDataToShop = (
  doc: firebase.firestore.QueryDocumentSnapshot<firebase.firestore.DocumentData>|firebase.firestore.DocumentSnapshot<firebase.firestore.DocumentData>
) => {
  const docData = doc.data()

  return {
    id: doc.id,
    name: docData ? docData.name : undefined
  } as Shop
}

export default defineComponent({
  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop
    })

    onMounted(async () => {
      const shopDoc = await getShop(context, context.root.$route.params.id)
      state.shop = firestoreDocDataToShop(shopDoc)
    })

    return {
      state
    }
  }
})
</script>
