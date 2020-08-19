<template>
  <div>
    <DefaultMainText>
      検索
    </DefaultMainText>

    <div class="u-light-grey-background">
      <v-container>
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
import { defineComponent } from '@vue/composition-api'

export default defineComponent({})
</script>

<style lang="scss" scoped>
.search-title {
  font-size: 0.75rem;
}

.search-detail {
  font-size: 0.9rem;
}
</style>
