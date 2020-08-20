<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        料理追加
      </AdminMainText>

      <v-btn to="/admin/dishes" color="success">
        料理一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <DishForm @submit="createDish" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { createDish as createDBDish } from '@/src/infra/firestore/Dish'
import { Dish } from '@/src/types/Dish'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const createDish = async (dish: Dish) => {
      await createDBDish(context.root.$fireStore, context.root.$fireStoreObj, dish)

      return await context.root.$router.push('/admin/dishes')
    }

    return {
      createDish
    }
  }
})
</script>
