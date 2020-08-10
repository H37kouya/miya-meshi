<template>
  <v-form @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="8">
        <MenuNameTextField
          v-model="state.menu.name"
        />
      </v-col>
    </v-row>
  </v-form>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Menu } from '@/src/types/Menu'
import { MenuFormState } from '@/src/types/MenuFormState'
import { isMenu } from '@/src/utils/Menu'

type Props = {
  menu?: Menu
}

export default defineComponent({
  props: {
    shop: {
      default: undefined,
      validator (v) {
        return isMenu(v)
      }
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive<MenuFormState>({
      menu: {
        name: undefined,
        description: undefined,
        intro: undefined,
        image: undefined,
        public: true,
        price: 0,
        isTaxIncluded: false,
        canTakeOut: false
      }
    })

    watch(() => props.menu, (newVal, _) => {
      state.menu.name = newVal ? newVal.name : undefined
    })

    const onSubmit = () => context.emit('submit', state.menu)

    return {
      state,
      onSubmit
    }
  }
})
</script>
