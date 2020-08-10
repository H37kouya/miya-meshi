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

    <v-row>
      <v-col cols="12" md="4" class="d-flex flex-row">
        <span class="pt-1 pr-2">
          テイクアウト可能かどうか
        </span>

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
    menu: {
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
      console.log(newVal)
      state.menu.name = newVal ? newVal.name : undefined
      state.menu.description = newVal ? newVal.description : undefined
      state.menu.intro = newVal ? newVal.intro : undefined
      state.menu.image = newVal ? newVal.image : undefined
      state.menu.public = newVal ? newVal.public : true
      state.menu.price = newVal ? newVal.price : 0
      state.menu.isTaxIncluded = newVal ? newVal.isTaxIncluded : false
      state.menu.canTakeOut = newVal ? newVal.canTakeOut : false
    })

    const onSubmit = () => context.emit('submit', state.menu)

    return {
      state,
      onSubmit
    }
  }
})
</script>
