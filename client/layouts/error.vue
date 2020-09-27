<template>
  <div class="mb-8">
    <v-container class="u-light-grey-background py-2 breadcrumbs-container mb-0">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <MainText v-if="error.statusCode === 404">
      {{ error.statusCode === 404 ? pageNotFound : otherError }}
    </MainText>

    <h2 class="error-detail mb-2 pt-2 px-2 border-t border-dark-gray">
      お探しのページが見つかりませんでした
    </h2>

    <div class="d-flex justify-center">
      <v-img
        src="/s/error-not-found.jpg"
        alt="お探しのページが見つかりませんでした"
      />
    </div>
  </div>
</template>

<script>
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
      pageNotFound: '404 Not Found',
      otherError: 'An error occurred'
    }
  },
  computed: {
    breadcrumbs: () => breadcrumbs
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
