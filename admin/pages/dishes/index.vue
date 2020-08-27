<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        料理一覧
      </AdminMainText>

      <v-btn to="/dishes/create" color="success">
        料理追加
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <DishDataTable :dishes="state.dishes" @delete="onDelete" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { Dish } from '@h37kouya/miyameshi-lib'
import { deleteDish, getDishList } from '@h37kouya/miyameshi-lib/src/infra/firestore/Dish'

type State = {
  dishes: Dish[]
}
export default defineComponent({
  middleware: 'admin-auth',

  setup (_, context: SetupContext) {
    const state = reactive<State>({
      dishes: [] as Dish[]
    })

    onMounted(async () => {
      state.dishes = await getDishList(context.root.$fireStore)
    })

    const onDelete = async (id: string) => {
      await deleteDish(context.root.$fireStore, id)

      state.dishes = state.dishes.filter(dish => dish.id !== id)
    }

    return {
      onDelete,
      state
    }
  }
})
</script>
