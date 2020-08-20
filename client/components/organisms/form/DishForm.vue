<template>
  <v-form @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="8">
        <v-card outlined>
          <v-card-text>
            <NameDishTextField
              v-model="state.dish.name"
            />

            <PriorityDishTextField
              v-model="state.dish.priority"
            />

            <div class="d-flex justify-end">
              <v-btn type="submit" color="primary" large>
                追加
              </v-btn>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-form>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Dish } from '@/src/types/Dish'

type State = {
  dish: Dish
}

type Props = {
  dish?: Dish
}

export default defineComponent({
  props: {
    dish: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive<State>({
      dish: {
        name: '',
        priority: 3
      } as Dish
    })

    watchEffect(() => {
      if (props.dish) {
        state.dish = props.dish
      }
    })

    const onSubmit = () => context.emit('submit', state.dish)

    return {
      state,
      onSubmit
    }
  }
})
</script>
