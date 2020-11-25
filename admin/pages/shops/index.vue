<template>
  <v-container>
    <v-row justify="space-between">
      <AdminMainText>
        店舗一覧
      </AdminMainText>

      <v-btn to="/shops/create" color="success">
        新規店舗追加
      </v-btn>
    </v-row>

    <v-row>
      <v-col cols="12">
        <div class="py-4">
          <v-form @submit.prevent="onSearch">
            <v-row>
              <v-col cols="12" md="4">
                <div>
                  <v-text-field
                    v-model="state.searchText"
                    outlined
                    hide-details
                    label="店舗名で検索"
                  />
                </div>
              </v-col>

              <v-col cols="6" md="4">
                <v-select
                  v-model="state.searchPriority"
                  label="優先度"
                  outlined
                  hide-details
                  :items="[
                    { text: '全て', value: 0 },
                    { text: 5, value: 5 },
                    { text: 4, value: 4 },
                    { text: 3, value: 3 },
                    { text: 2, value: 2 },
                    { text: 1, value: 1 }
                  ]"
                />
              </v-col>

              <v-col cols="6" md="4">
                <v-select
                  v-model="state.searchPublic"
                  label="公開設定"
                  outlined
                  hide-details
                  :items="[
                    { text: '全て', value: null },
                    { text: '公開中', value: true },
                    { text: '非公開', value: false },
                  ]"
                />
              </v-col>
            </v-row>

            <v-row align="end">
              <v-col cols="6" md="4" class="pb-0">
                <v-text-field
                  v-model.number="state.searchInstaNumber"
                  label="インスタ番号"
                  outlined
                  hide-details
                  type="number"
                  clearable
                />
              </v-col>

              <div class="ml-auto">
                <v-btn type="submit" color="primary">
                  検索
                </v-btn>
              </div>
            </v-row>

          </v-form>
        </div>

        <div id="shop_list">
          <AdminShopListCard :shops="pagination.shops" />
        </div>

        <div v-if="pagination.totalVisible !== 1" class="pt-4">
          <v-pagination
            :value="nowPage"
            :length="pagination.totalVisible"
            @input="onPagination"
          />
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, onMounted, computed } from '@vue/composition-api'
import { MetaInfo } from 'vue-meta'
import VueScrollTo from 'vue-scrollto'
import { Shop } from '@/lib'
import { getShopList } from '@/src/infra/firestore/Shop'
import { isArray } from '@/src/utils/Array'
import { isString } from '~/src/utils/String'

type State = {
  searchText: string,
  searchPublic: boolean|null
  searchPriority: number
  searchInstaNumber: number|null
  shops: Shop[]
}

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive<State>({
      searchText: isString(context.root.$route.query.name) ? context.root.$route.query.name : '',
      searchPublic: (() => {
        if (context.root.$route.query.public === 'true') {
          return true
        }

        if (context.root.$route.query.public === 'false') {
          return false
        }

        return null
      })(),
      searchPriority: Number(context.root.$route.query.priority) || 0,
      searchInstaNumber: Number(context.root.$route.query.instaNumber) || null,
      shops: [] as Shop[]
    })

    onMounted(async () => {
      state.shops = await getShopList(context.root.$fireStore, 0, true)
    })

    const filterShops = computed(() => {
      const name = context.root.$route.query.name
      const _priority = Number(context.root.$route.query.priority)
      const _public = (() => {
        if (context.root.$route.query.public === 'true') {
          return true
        }

        if (context.root.$route.query.public === 'false') {
          return false
        }

        return null
      })()
      const _nameToLower = isString(name) ? name.toLowerCase() : ''
      const _instaNumber = Number(context.root.$route.query.instaNumber) || null

      return state.shops.filter((shop: Shop) => {
        if (_nameToLower && shop.name && !shop.name.toLowerCase().includes(_nameToLower)) {
          return false
        }

        if ((_public === true || _public === false) && shop.public !== _public) {
          return false
        }

        if (_priority && _priority !== shop.priority) {
          return false
        }

        if (_instaNumber && _instaNumber !== shop.instaNumber) {
          return false
        }

        return true
      })
    })

    const pagination = computed(() => {
      return {
        shops: filterShops.value.slice((nowPage.value - 1) * 15, nowPage.value * 15),
        totalVisible: Math.floor(filterShops.value.length / 15) + 1
      }
    })

    const nowPage = computed(() => {
      const page = context.root.$route.query.page
      if (isArray(page)) {
        return 1
      }

      const pageNumber = Number(page)
      return Number.isInteger(pageNumber) ? pageNumber : 1
    })

    const onPagination = async (page: number) => {
      VueScrollTo.scrollTo('#shop_list', {
        offset: -120
      })

      await context.root.$router.push({
        path: '/shops',
        query: {
          page: String(page),
          name: state.searchText || undefined,
          priority: (state.searchPriority !== 0 && String(state.searchPriority)) || undefined,
          public: (state.searchPublic !== null && String(state.searchPublic)) || undefined,
          instaNumber: String(state.searchInstaNumber)
        }
      })
    }

    const onSearch = async () => {
      return await context.root.$router.push({
        path: '/shops',
        query: {
          name: state.searchText || undefined,
          priority: (state.searchPriority !== 0 && String(state.searchPriority)) || undefined,
          public: (state.searchPublic !== null && String(state.searchPublic)) || undefined,
          instaNumber: String(state.searchInstaNumber)
        }
      })
    }

    return {
      filterShops,
      state,
      nowPage,
      pagination,
      onPagination,
      onSearch
    }
  },

  head (): MetaInfo {
    return {
      title: '店舗一覧'
    }
  }
})
</script>
