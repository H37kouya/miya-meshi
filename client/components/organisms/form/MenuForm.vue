<template>
  <v-form @submit.prevent="onSubmit">
    <v-row>
      <v-col cols="8">
        <MenuNameTextField
          v-model="state.menu.name"
        />
      </v-col>

      <v-col cols="4">
        <v-switch
          v-model="state.menu.public"
          :label="state.menu.public ? '公開' : '非公開'"
          class="mt-0"
        />
      </v-col>
    </v-row>

    <p>テイクアウト可能かどうか</p>
    <v-row>
      <v-col cols="4">
        <v-switch
          v-model="state.menu.canTakeOut"
          :label="state.menu.canTakeOut ? '可能' : '不可能'"
          class="mt-0"
        />
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12">
        <MenuDescriptionTextField
          v-model="state.menu.description"
        />
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12">
        <MenuIntroTextarea
          v-model="state.menu.intro"
        />
      </v-col>
    </v-row>

    <p>値段設定</p>
    <v-row>
      <v-col cols="4" sm="3">
        <PriceTextField
          v-model="state.menu.price"
        />
      </v-col>

      <v-col cols="4">
        <v-switch
          v-model="state.menu.isTaxIncluded"
          :label="state.menu.isTaxIncluded ? '税込' : '税抜'"
          class="mt-0"
        />
      </v-col>
    </v-row>

    <v-btn type="submit" color="primary">
      追加
    </v-btn>
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
