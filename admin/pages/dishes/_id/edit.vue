<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        料理編集
      </AdminMainText>

      <v-btn to="/dishes" color="success">
        料理一覧へ戻る
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <DishForm :dish="state.dish" @submit="editDish" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Dish } from '@/lib'
import { getDishByID, editDish as editDBDish } from '@/src'/infra/firestore/Dish'

type State = {
  dish: Dish
}

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive<State>({
      dish: {} as Dish
    })

    const editDish = async (dish: any) => {
      await editDBDish(context.root.$fireStore, context.root.$fireStoreObj, dish, state.dish.id)

      return await context.root.$router.push('/dishes')
    }

    watchEffect(async () => {
      state.dish = await getDishByID(context.root.$fireStore, context.root.$route.params.id)
    })

    return {
      state,
      editDish
    }
  }
})
</script>
