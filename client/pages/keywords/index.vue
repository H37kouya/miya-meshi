<template>
  <div>
    <DefaultMainText>
      検索
    </DefaultMainText>

    <div class="u-light-grey-background">
      <v-container>
        <v-row justify="center">
          <div class="max-width-480">
            <div>
              <p class="mb-0 free-word-search">
                フリーワード検索
              </p>
              <SearchTextField />
            </div>

            <div class="text-center">
              <div class="py-4">
                <p>作成中</p>
              </div>

              <v-list class="max-width-480">
                <v-list-item to="/shops">
                  店舗一覧へ
                </v-list-item>
                <v-list-item to="/menus">
                  メニュー一覧へ
                </v-list-item>
              </v-list>
            </div>
          </div>
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
.free-word-search {
  font-size: 0.75rem;
}
</style>
