<template>
  <v-container>
    <v-btn to="/admin/shops">
      Go To Shop List
    </v-btn>

    <div>
      <v-form @submit.prevent="createShop">
        <v-text-field
          v-model="state.shop.name"
          label="店名"
        />

        <v-btn type="submit" color="primary">
          追加
        </v-btn>
      </v-form>
    </div>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext } from '@vue/composition-api'

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shop: {
        name: null as string|null,
        public: false
      }
    })

    const createShop = async () => {
      await context.root.$fireStore.collection('shops').add({
        name: state.shop.name
      })

      return await context.root.$router.push('/admin/shops')
    }

    return {
      createShop,
      state
    }
  }
})
</script>
