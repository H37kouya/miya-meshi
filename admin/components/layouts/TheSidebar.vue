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
          title: 'トップページ',
          to: '/'
        },
        {
          icon: 'mdi-store',
          title: '店舗一覧',
          to: '/shops'
        },
        {
          icon: 'mdi-store',
          title: '新規店舗追加',
          to: '/shops/create'
        },
        {
          icon: 'mdi-alpha-t-box-outline',
          title: 'タグ一覧',
          to: '/keywords'
        },
        {
          icon: 'mdi-food',
          title: 'ジャンル一覧',
          to: '/dishes'
        },
        {
          icon: 'mdi-cash',
          title: '価格帯一覧',
          to: '/price-ranges'
        },
        {
          icon: 'mdi-map',
          title: 'エリア一覧',
          to: '/area'
        },
        {
          icon: 'mdi-cog',
          title: '設定',
          to: '/settings'
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
