<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container mb-2">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <v-container class="pa-0">
      <v-row class="mx-0">
        <v-col cols="12" md="8" class="px-0 px-md-3 py-0">
          <div class="post-title">
            <MainText>
              ブログ一覧
            </MainText>
          </div>

          <div class="border-b border-dark-gray">
            <h3 class="pl-4 pt-4">
              最新の投稿
            </h3>
          </div>

          <v-row>
            <template v-for="(post, key) in paginationPost.records">
              <v-col :key="key" cols="12" sm="6">
                <BlogCard
                  :post="post"
                />
              </v-col>
            </template>
          </v-row>
        </v-col>

        <v-col cols="12" md="4" class="d-none d-md-block pt-0">
          <div>
            <v-card href="https://forms.gle/gAknXAaCrfsr8UdA8" target="_blank" rel="noopener" flat>
              <v-img src="/s/recruitment-shop.png" alt="掲載希望の方はこちら" />
            </v-card>
          </div>

          <div class="mt-8">
            <adsbygoogle
              ad-slot="7220123703"
            />
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { Breadcrumb } from '@/lib'
import { usePostList } from '@/src/CompositonFunctions/posts/UsePostList'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { text: 'ブログ一覧', to: '/post' }
] as Breadcrumb[]

export default defineComponent({
  watchQuery: ['page'],

  setup (_, context: SetupContext) {
    const { paginationPost } = usePostList(context.root.$config.API_URL, context.root.$axios)

    return {
      breadcrumbs,
      paginationPost
    }
  },

  head: () => ({
    title: 'ブログ一覧'
  })
})
</script>

<style lang="scss" scoped>
.post-title {
  background: #faf8f5;
}
</style>
