<template>
  <div class="u-light-grey-background recommend-container">
    <v-container class="py-4">
      <v-row>
        <template v-for="(menu, key) in menus">
          <v-col :key="menu.id" cols="12" md="4" class="px-4" :class="{ 'mb-4': menus.length - 1 !== key }">
            <template v-if="screenMd">
              <MenuCard v-bind="menu" :src="menu.image" />
            </template>

            <template v-else>
              <ShopRecommendListItem :menu="menu" />
            </template>
          </v-col>
        </template>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { Menu } from '@/lib'
import { useGetScreenSize } from '@/src/CompositonFunctions/utils/UseGetScreenSize'

type State = {
  menus: Menu[]
}

type Props = {
  menus: Menu[]
}

export default defineComponent({
  props: {
    menus: Array,
    default: () => []
  },

  setup () {
    const { screenMd } = useGetScreenSize()

    return {
      screenMd
    }
  }
})
</script>

<style lang="scss" scoped>
.recommend-container {
  @include mq(md) {
    background: #fff;
  }
}
</style>
