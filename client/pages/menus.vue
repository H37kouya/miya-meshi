<template>
  <div>
    <DefaultMainText>
      食べ物から探す
    </DefaultMainText>

    <v-container>
      <v-row justify="center">
        <template v-for="(menu, key) in state.menus">
          <v-col :key="key" cols="4" md="3" class="px-1">
            <MenuCard v-bind="menu" src="/sample_niku.jpg" />
          </v-col>
        </template>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { getMenuList } from '@/src/infra/firestore/Menu'
import { Menu } from '@/src/types/Menu'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      menus: [] as Menu[]
    })

    onMounted(async () => {
      state.menus = await getMenuList(context.root.$fireStore)
    })

    return {
      state
    }
  }
})
</script>
