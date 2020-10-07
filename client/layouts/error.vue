<template>
  <div class="mb-8">
    <v-container class="u-light-grey-background py-2 breadcrumbs-container mb-0">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <v-container class="py-0">
      <v-row>
        <v-col cols="12" class="pa-0">
          <MainText>
            {{ error.statusCode === 404 ? pageNotFound : otherError }}
          </MainText>

          <h2 class="error-detail py-4 px-2 border-t border-dark-gray">
            {{ explanation[error.statusCode === 404 ? 404 : 500] }}
          </h2>
        </v-col>
      </v-row>

      <div class="py-sm-8">
        <template v-if="error.statusCode === 404">
          <div class="d-sm-none">
            <v-card
              max-width="360px"
              width="100%"
              flat
              class="mx-auto"
            >
              <v-img
                :src="Image404Mobile"
                :alt="explanation[404]"
              />
            </v-card>
          </div>

          <div class="d-none d-sm-block">
            <v-card
              class="mx-auto"
              flat
              max-width="800px"
              width="100%"
            >
              <v-img
                :src="Image404Pc"
                :alt="explanation[404]"
              />
            </v-card>
          </div>
        </template>

        <template v-else>
          <div class="d-sm-none">
            <v-card
              max-width="360px"
              width="100%"
              flat
              class="mx-auto"
            >
              <v-img
                :src="Image500Mobile"
                :alt="explanation[500]"
              />
            </v-card>
          </div>

          <div class="d-none d-sm-block">
            <v-card
              class="mx-auto"
              flat
              max-width="800px"
              width="100%"
            >
              <v-img
                :src="Image500Pc"
                :alt="explanation[500]"
              />
            </v-card>
          </div>
        </template>
      </div>
    </v-container>
  </div>
</template>

<script>
import Image404Mobile from '@/assets/image/miyameshi404_mobile.jpg'
import Image404Pc from '@/assets/image/miyameshi404_pc.jpg'
import Image500Mobile from '@/assets/image/miyameshi500_mobile.jpg'
import Image500Pc from '@/assets/image/miyameshi500_pc.jpg'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { exact: true, text: 'お店で探す', to: '/shops' }
]

export default {
  layout: 'empty',
  props: {
    error: {
      type: Object,
      default: null
    }
  },
  data () {
    return {
      pageNotFound: 'Page Not Found',
      otherError: 'Internal Server Error'
    }
  },
  computed: {
    breadcrumbs: () => breadcrumbs,

    explanation: () => ({
      404: '404 - お探しのページが見つかりませんでした',
      500: '500 - サーバーでエラーが発生しました。'
    }),

    Image404Mobile: () => Image404Mobile,
    Image404Pc: () => Image404Pc,
    Image500Mobile: () => Image500Mobile,
    Image500Pc: () => Image500Pc
  },

  head () {
    const title =
      this.error.statusCode === 404 ? this.pageNotFound : this.otherError
    return {
      title
    }
  }
}
</script>

<style lang="scss" scoped>
.error-detail {
  font-size: 1rem;
  font-weight: bolder;
}
</style>
