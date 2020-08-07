<template>
  <v-navigation-drawer
    v-model="drawer"
    :mini-variant="false"
    clipped
    fixed
    app
  >
    <v-list>
      <v-list-item
        v-for="(item, i) in items"
        :key="i"
        :to="item.to"
        router
        exact
      >
        <v-list-item-action>
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title v-text="item.title" />
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  props: {
    value: {
      type: Boolean,
      default: false
    }
  },

  data () {
    return {
      items: [
        {
          icon: 'mdi-apps',
          title: 'Top Page',
          to: '/admin'
        },
        {
          icon: 'mdi-store',
          title: 'Shop List',
          to: '/admin/shops'
        }
      ]
    }
  },

  computed: {
    drawer: {
      get () {
        return this.value
      },
      set (newVal) {
        return this.$emit('input', newVal)
      }
    }
  }
}
</script>
