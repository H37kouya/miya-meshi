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
            <div class="d-flex align-center max-width-350">
              <v-text-field
                v-model="state.searchText"
                class="mr-4"
                outlined
                hide-details
                label="店舗名で検索"
              />

              <v-btn type="submit" color="primary">
                検索
              </v-btn>
            </div>
          </v-form>
        </div>

        <AdminShopListCard :shops="pagination.shops" />

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
import { Shop } from '@/lib'
import { getShopList } from '@/src/infra/firestore/Shop'
import { isArray } from '@/src/utils/Array'
import { isString } from '~/src/utils/String'

type State = {
  searchText: string,
  shops: Shop[]
}

export default defineComponent({
  middleware: 'admin-auth',

  setup (_: unknown, context: SetupContext) {
    const state = reactive<State>({
      searchText: isString(context.root.$route.query.name) ? context.root.$route.query.name : '',
      shops: [] as Shop[]
    })

    onMounted(async () => {
      state.shops = await getShopList(context.root.$fireStore, 0, true)
    })

    const filterShops = computed(() => {
      const name = context.root.$route.query.name
      if (name) {
        return state.shops.filter((shop: Shop) => {
          if (!shop.name) {
            return false
          }
          return name.includes(shop.name)
        })
      }

      return state.shops
    })

    const pagination = computed(() => {
      return {
        shops: filterShops.value.slice((nowPage.value - 1) * 10, nowPage.value * 10),
        totalVisible: Math.floor(filterShops.value.length / 10) + 1
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
      return await context.root.$router.push({
        path: '/shops',
        query: {
          page: String(page)
        }
      })
    }

    const onSearch = async () => {
      return await context.root.$router.push({
        path: '/shops',
        query: {
          name: state.searchText || undefined
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
