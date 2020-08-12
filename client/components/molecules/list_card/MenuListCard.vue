<template>
  <v-card>
    <v-card-title>
      メニュー一覧
    </v-card-title>

    <v-list>
      <v-list-item v-for="(menu, key) in menus" :key="key" :to="`/admin/menus/${menu.id}`">
        <v-list-item-avatar>
          <v-img v-if="menu.image" :src="menu.image" :alt="`${menu.name}`" />
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title>
            <v-icon :color="menu.public ? 'success' : 'grey'">
              {{ menu.public ? 'mdi-check-circle' : 'mdi-alert-circle' }}
            </v-icon>
            {{ menu.name }}
          </v-list-item-title>
          <v-list-item-subtitle v-if="menu.description">
            {{ menu.description }}
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-card>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import { Menu } from '~/src/types/Menu'

type Props = {
  menu: Menu[]
}

export default defineComponent({
  props: {
    menus: Array,
    default: () => []
  }
})
</script>
