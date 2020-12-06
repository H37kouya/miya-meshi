<template>
  <component
    :is="[ContentMode.NO_CONTENT, ContentMode.ADVERTISING].includes(post.content_mode) ? 'a' : 'nuxt-link'"
    :to="[ContentMode.NO_CONTENT, ContentMode.ADVERTISING].includes(post.content_mode) ? undefined : `/post/${post.id}`"
    :href="[ContentMode.NO_CONTENT, ContentMode.ADVERTISING].includes(post.content_mode) ? post.link : undefined"
    :target="[ContentMode.NO_CONTENT, ContentMode.ADVERTISING].includes(post.content_mode) ? '_blank' : undefined"
    :rel="[ContentMode.NO_CONTENT, ContentMode.ADVERTISING].includes(post.content_mode) ? 'noopener' : undefined"
    class="text-decoration-none"
  >
    <div class="px-4 px-sm-0">
      <v-card v-bind="$attrs" class="pos-relative" :flat="screenMd">
        <v-img
          :alt="`${post.title} - サムネイル`"
          :aspect-ratio="1.73"
          :src="post.image ? post.image : 'no-image.png'"
          min-height="80px"
        />

        <template v-if="[ContentMode.NO_CONTENT, ContentMode.ADVERTISING].includes(post.content_mode) && post.link">
          <div class="post-number-container">
            <p class="mb-0 post-text">
              <span class="post-explanation">
                {{ post.content_mode === ContentMode.ADVERTISING ? '広告' : '外部リンク' }}
              </span>
            </p>
          </div>
        </template>
      </v-card>

      <h4 class="my-1 post-title u-black--text max-text-height-2">
        {{ post.title }}
      </h4>

      <div v-if="post.description">
        <p class="u-black--text post-description">{{ post.description }}</p>
      </div>
    </div>
  </component>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'
import { Post } from '@/lib'
import { ContentMode } from '@/lib/enum/ContentMode'
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
      screenMd,
      ContentMode
    }
  }
})
</script>

<style lang="scss" scoped>
.post-title {
  font-size: 1.1rem;
  font-weight: bold;

  @include mq(sm) {
    font-size: 1.2rem;
  }
}

.post-description {
  font-size: 0.8rem;
}

.post-number-container {
  position: absolute;
  top: 0.375rem;
  right: 0.375rem;
}

.post-text {
  background: rgba(#000, 60%);
  border-radius: 4px;
  color: $white;
  font-size: 0.7rem;
  line-height: 1.1;
  padding: 0.175rem 0.25rem;

  @include mq(sm) {
    font-size: 0.7rem;
  }

  @include mq(md) {
    border-radius: 1px;
  }
}

.post-explanation {
  font-size: 0.95rem;
  font-weight: 500;
}
</style>
