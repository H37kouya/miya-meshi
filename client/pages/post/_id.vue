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

            <div v-html="post.contents" />
          </v-container>
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
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@nuxtjs/composition-api'
import dayjs from 'dayjs'
import { Area, Breadcrumb } from '@/lib'
import { usePost } from '@/src/CompositonFunctions/posts/UsePost'
import { Context } from '@nuxt/types'
import { getAreaByID } from '@/src/infra/firestore/Area'

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

    const { post } = usePost(postId.value, context.root.$config.API_URL, context.root.$axios)

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
}

.post-updatedat {
  font-size: 0.8rem;
}
</style>
