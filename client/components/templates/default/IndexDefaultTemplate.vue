<template>
  <div>
    <DefaultMainText>
      今週のおすすめ
    </DefaultMainText>

    <DefaultMenuList :menus="state.menus" />

    <DefaultMainText>
      新着情報
    </DefaultMainText>

    <v-row class="mx-0 mb-4" justify="center">
      <template v-for="(news, key) in state.newsList">
        <v-col :key="`news${key}`" cols="12" sm="4" md="3" class="px-0 pt-0 px-sm-2">
          <NewsField v-bind="news" />
        </v-col>
      </template>
    </v-row>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Menu } from '@/src/types/Menu'
import { News } from '@/src/types/News'

type State = {
  menus: Props['menus'],
  newsList: Props['newsList']
}

type Props = {
  menus: Menu[],
  newsList: News[]
}

export default defineComponent({
  props: {
    menus: {
      type: Array,
      default: () => []
    },

    newsList: {
      type: Array,
      default: () => []
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive<State>({
      menus: props.menus,
      newsList: props.newsList
    })

    watchEffect(() => {
      state.menus = props.menus
    })

    watchEffect(() => {
      state.newsList = props.newsList
    })

    return {
      state
    }
  }
})
</script>
