<template>
  <nuxt-link :to="`/post/${post.id}`" class="text-decoration-none">
    <v-card v-bind="$attrs" class="pos-relative" :flat="screenMd">
      <v-img
        :alt="`${post.title} - サムネイル`"
        :aspect-ratio="screenMd ? 1.73 : 1.2"
        :src="post.image ? post.image : 'no-image.png'"
        min-height="80px"
      />
    </v-card>

    <div class="px-4 px-sm-0">
      <h4 class="mb-0 post-title u-black--text max-text-height-1">
        {{ post.title }}
      </h4>

      <div v-if="post.description">
        <p class="u-black--text post-description">{{ post.description }}</p>
      </div>
    </div>
  </nuxt-link>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'
import { Post } from '@/lib'
import { useGetScreenSize } from '~/src/CompositonFunctions/utils/UseGetScreenSize'

type Props = {
  post: Post
}
export default defineComponent({
  props: {
    post: {
      type: Object,
      default: () => ({} as Post)
    }
  },

  setup (props: Props, _) {
    const { screenMd } = useGetScreenSize()

    return {
      screenMd
    }
  }
})
</script>

<style lang="scss" scoped>
.post-title {
  font-size: 0.9rem;
  font-weight: bolder;

  @include mq(sm) {
    font-size: 1.2rem;
  }
}

.post-description {
  font-size: 0.85rem;
}
</style>
