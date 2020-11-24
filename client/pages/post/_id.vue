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
              {{ post.title }}
            </MainText>
          </div>

          <v-container>
            <div class="d-flex justify-space-between">
              <div>
                <p class="mb-0 post-updatedat">
                  <time :datetime="post.updatedAt" class="d-flex align-center">
                    <v-icon class="mr-1">mdi-clock-time-four</v-icon><span>{{ formatUpdatedAt }}</span>
                  </time>
                </p>
              </div>

              <div v-if="state.area">
                <p class="mb-0">
                  <v-icon color="#d4573c" small>
                    mdi-map-marker
                  </v-icon>
                  {{ state.area.name }}
                </p>
              </div>
            </div>
          </v-container>

          <div v-if="post.image">
            <div class="d-flex justify-center">
              <v-img
                max-width="600px"
                width="100%"
                :alt="`${post.title} - サムネイル`"
                :src="post.image"
              />
            </div>
          </div>

          <v-container id="post_content">
            <div class="post-description">
              <p>{{ post.description }}</p>
            </div>

            <div class="post-main-content">
              <div v-html="post.contents" />
            </div>
          </v-container>
        </v-col>

        <v-col cols="12" md="4" class="d-none d-md-block pt-0">
          <div class="border-md-4 border-gray mb-8">
            <MainText id="news" :level="2">
              新着情報
            </MainText>

            <v-row class="mx-0 mb-4" justify="center">
              <template v-for="(news, key) in newsList">
                <v-col :key="`news${key}`" cols="12" class="px-0 pt-0">
                  <NewsField
                    :alt="news.hashtags[0]"
                    :href="news.href"
                    :to="news.to"
                    :hashtags="news.hashtags"
                    :src="news.src"
                    :text="news.text"
                  />
                </v-col>
              </template>
            </v-row>
          </div>

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
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@nuxtjs/composition-api'
import dayjs from 'dayjs'
import { Area, Breadcrumb } from '@/lib'
import { usePost } from '@/src/CompositonFunctions/posts/UsePost'
import { Context } from '@nuxt/types'
import { getAreaByID } from '@/src/infra/firestore/Area'
import { useNews } from '~/src/CompositonFunctions/news/UseNews'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: 'ブログ一覧', to: '/post' }
] as Breadcrumb[]

export default defineComponent({
  validate (ctx: Context) {
    return Number.isInteger(Number(ctx.params.id))
  },

  setup (_, context: SetupContext) {
    const state = reactive({
      area: {} as Area|undefined
    })

    const postId = computed(() => {
      return Number(context.root.$route.params.id)
    })

    const { newsList } = useNews()

    const { post } = usePost(postId.value, process.env.API_URL || '', context.root.$axios)

    const formatUpdatedAt = computed(() => dayjs(post.value.updatedAt).format('YYYY年MM月DD日'))

    const newBreadcrumbs = computed(() => [
      ...breadcrumbs,
      {
        text: post.value.title,
        to: `/post/${context.root.$route.params.id}`
      }
    ])

    watchEffect(async () => {
      state.area = post.value && post.value.firebase_area_ids && post.value.firebase_area_ids.length > 0
        ? await getAreaByID(context.root.$fireStore, post.value.firebase_area_ids[0])
        : undefined
    })

    return {
      state,
      newsList,
      breadcrumbs: newBreadcrumbs,
      formatUpdatedAt,
      post
    }
  },

  head: () => ({
    title: 'お店から探す'
  })
})
</script>

<style lang="scss" scoped>
.post-title {
  background: #faf8f5;
}

.post-description {
  font-weight: bolder;
  font-size: 1rem;
}

.post-updatedat {
  font-size: 0.8rem;
}
</style>
