<template>
  <a :href="href" rel="noopener" target="_blank" class="text-decoration-none max-width-480">
    <div class="mb-2 pos-relative">
      <v-img :src="src" :alt="alt" aspect-ratio="2" />

      <div class="news-badge">
        News
      </div>
    </div>

    <div class="px-4">
      <p class="u-black--text news-text mb-0">{{ text }}</p>
      <div class="hashtags">
        <span v-for="(tag, key) in hashtag" :key="key" class="hashtag mr-1">{{ tag }}</span>
      </div>
    </div>
  </a>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'

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

    hashtag: {
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
    }
  }
})
</script>

<style lang="scss" scoped>
.news-badge {
  position: absolute;
  top: 0;
  left: 1rem;
  padding: 0.5rem 1rem;
  background-color: #f2dc15;
  text-align: center;
  color: #333;
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
</style>
