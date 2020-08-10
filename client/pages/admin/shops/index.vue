<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        店舗一覧
      </AdminMainText>

      <v-btn to="/admin/shops/create" color="success">
        新規店舗追加
      </v-btn>
    </v-row>

    <v-card class="mt-4">
      <v-list two-line>
        <template v-for="(shop, idx) in state.shops">
          <v-list-item :key="shop.id" :to="`/admin/shops/${shop.id}`">
            <v-list-item-avatar>
              <v-icon
                :color="shop.public ? 'success' : 'grey'"
              >
                {{ shop.public ? 'mdi-check-circle' : 'mdi-alert-circle' }}
              </v-icon>
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title>{{ shop.name }}</v-list-item-title>
              <v-list-item-subtitle v-if="shop.intro">
                {{ shop.intro }}
              </v-list-item-subtitle>
            </v-list-item-content>

            <v-list-item-action>
              <v-btn icon>
                <v-icon v-if="1 <= shop.priority && shop.priority <= 5" color="grey">
                  {{ `mdi-numeric-${shop.priority}-circle` }}
                </v-icon>
                <v-icon v-else color="grey">
                  mdi-numeric-1-circle
                </v-icon>
              </v-btn>
            </v-list-item-action>
          </v-list-item>

          <v-divider
            v-if="idx + 1 < state.shops.length"
            :key="idx"
          />
        </template>
      </v-list>
    </v-card>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, onMounted } from '@vue/composition-api'
import { MetaInfo } from 'vue-meta'
import { Shop } from '@/src/types/Shop'
import { getShopList } from '@/src/infra/firestore/Shop'

export default defineComponent({
  middleware: 'admin-auth',

  layout: 'auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive({
      shops: [] as Shop[]
    })

    onMounted(async () => {
      state.shops = await getShopList(context.root.$fireStore)
    })

    return {
      state
    }
  },

  head (): MetaInfo {
    return {
      title: '店舗一覧'
    }
  }
})
</script>
