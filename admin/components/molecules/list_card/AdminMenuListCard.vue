<template>
  <v-card>
    <div class="d-flex justify-space-between align-center">
      <v-card-title>
        メニュー一覧
      </v-card-title>

      <div class="pr-4">
        <v-btn :to="`/menus/create/?shopid=${shopid}`" color="light-green lighten-4">
          新規メニュー追加
        </v-btn>
      </div>
    </div>

    <v-list>
      <v-list-item v-for="(menu, key) in menus" :key="key" :to="`/menus/${menu.id}`">
        <v-list-item-avatar>
          <v-img v-if="menu.image" :src="menu.image" :alt="`${menu.name}`" />
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title class="d-flex justify-space-between">
            <div>
              <v-icon :color="menu.public ? 'success' : 'grey'">
                {{ menu.public ? 'mdi-check-circle' : 'mdi-alert-circle' }}
              </v-icon>
              {{ menu.name }}
            </div>

            <div v-if="menu.canTakeout">
              <v-chip small outlined>
                テイクアウト可
              </v-chip>
            </div>
          </v-list-item-title>
          <v-list-item-subtitle v-if="menu.description">
            <span>{{ menu.description }}</span>
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-card>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import { Menu, Shop } from '@/lib'

type Props = {
  menu: Menu[],
  shopid: Shop['id']
}

export default defineComponent({
  props: {
    menus: {
      type: Array,
      default: () => []
    },

    shopid: {
      type: String,
      default: undefined
    }
  }
})
</script>
