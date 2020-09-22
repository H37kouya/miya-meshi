<template>
  <div>
    <MainText id="search_title">
      検索
    </MainText>

    <div class="u-light-grey-background">
      <v-container>
        <div>
          <v-breadcrumbs :items="breadcrumbs" class="pb-0 px-0 px-sm-6" />
        </div>

        <v-row justify="center">
          <v-col cols="12" class="d-flex justify-center">
            <div class="max-width-480">
              <div class="mb-2">
                <p class="mb-0 search-title">
                  フリーワード検索
                </p>
                <SearchTextField />
              </div>

              <div>
                <p class="mb-0 search-title">
                  ジャンル検索
                </p>
              </div>

              <div class="text-center">
                <div class="py-4">
                  <p>作成中</p>
                </div>

                <v-list class="max-width-480 mb-4">
                  <v-list-item to="/shops">
                    店舗一覧へ
                  </v-list-item>
                  <v-list-item to="/menus">
                    メニュー一覧へ
                  </v-list-item>
                </v-list>

                <div class="text-right search-detail">
                  <nuxt-link to="/keywords/detail">
                    さらに細かく検索する
                  </nuxt-link>
                </div>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { MetaInfo } from 'vue-meta'
import { useDish } from '@/src/CompositonFunctions/dishes/UseDishes'
import { Breadcrumb } from '~/lib'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: '検索', to: '/keywords' }
] as Breadcrumb[]

export default defineComponent({
  setup (_, context: SetupContext) {
    const { dishes } = useDish(context.root)

    return {
      breadcrumbs,
      dishes
    }
  },

  head: (): MetaInfo => ({
    title: '検索',
    meta: [
      { property: 'og:type', content: 'article' }
    ]
  })
})
</script>

<style lang="scss" scoped>
.search-title {
  font-size: 0.75rem;
}

.search-detail {
  font-size: 0.9rem;
}

.to-top-page {
  font-size: 0.8rem;
  text-decoration: none;

  &::before {
    content: '←';
  }
}
</style>
