<template>
  <v-container>
    <v-btn to="/admin/shops">
      Go To Shop List
    </v-btn>

    <div>
      <ShopForm
        @submit="createShop"
      />
    </div>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { ShopFormState } from '~/src/types/ShopFormState'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const createShop = async (shop: ShopFormState) => {
      await context.root.$fireStore.collection('shops').add({
        name: shop.name
      })

      return await context.root.$router.push('/admin/shops')
    }

    return {
      createShop
    }
  }
})
</script>
