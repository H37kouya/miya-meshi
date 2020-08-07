<template>
  <v-container>
    <v-row class="mb-4" justify="space-between">
      <h1>新規店舗追加</h1>

      <v-btn to="/admin/shops">
        Go To Shop List
      </v-btn>
    </v-row>

    <v-row>
      <ShopForm
        @submit="createShop"
      />
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { ShopFormState } from '~/src/types/ShopFormState'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const createShop = async ({ shop }: ShopFormState) => {
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
