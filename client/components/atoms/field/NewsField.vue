<template>
  <component
    :is="href ? 'a' : 'nuxt-link'"
    :to="to"
    :href="href"
    :rel="href ? 'noopener' : undefined"
    :target="href ? '_blank' : undefined"
    class="text-decoration-none max-width-480"
  >
    <div class="mb-2 pos-relative border-y border-dark-gray">
      <v-img :src="src" :alt="alt" aspect-ratio="1.78" />

      <div class="d-md-none news-badge u-black--text">
        News
      </div>
    </div>

    <div class="px-4">
      <p class="u-black--text news-text mb-0">{{ text }}</p>
      <div class="hashtags">
        <span v-for="(tag, key) in hashtags" :key="key" class="hashtag mr-1">{{ tag }}</span>
      </div>

      <div class="text-right">
        <span class="read-continue">続きを見る</span>
      </div>
    </div>
  </component>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api'

type Props = {
  alt?: string,
  href?: string,
  hashtags: string[],
  src?: string,
  text?: string
  to?: string
}

export default defineComponent({
  props: {
    alt: {
      type: String,
      default: undefined
    },

    href: {
      type: String,
      default: undefined
    },

    hashtags: {
      type: Array,
      default: () => []
    },

    src: {
      type: String,
      default: undefined
    },

    text: {
      type: String,
      default: undefined
    },

    to: {
      type: String,
      default: undefined
    }
  }
})
</script>

<style lang="scss" scoped>
.news-badge {
  $news-color: #fef552;

  position: absolute;
  top: 0;
  left: 1rem;
  padding: 0.5rem 0;
  background-color: $news-color;
  text-align: center;
  width: 44px;
  font-size: 0.9rem;

  &::after {
    content: '';
    position: absolute;
    left: 0;
    top: 100%;
    height: 0;
    width: 0;
    border-left: 22px solid $news-color;
    border-right: 22px solid $news-color;
    border-bottom: 10px solid transparent;
  }
}

.news-text {
  font-size: 0.8rem;
}

.hashtag {
  color: #596cb2;
  font-size: 0.75rem;

  &::before {
    content: '#';
  }
}

.read-continue {
  font-size: 0.8rem;

  &::after {
    content: '→';
  }
}
</style>
