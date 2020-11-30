<template>
  <div class="border-md-4 border-gray">
    <div class="d-none d-md-block">
      <div v-if="shop.tel" class="border-b-4 border-gray">
        <div class="border-b border-dark-gray">
          <h3 class="contact-title pt-4 px-4 pb-2">
            電話
          </h3>
        </div>

        <p class="cotact-tel mb-0 px-4 py-2">
          {{ shop.tel }}
        </p>
      </div>

      <div v-if="type !== 'contact' && shop.latitude && shop.longitude" class="border-b-4 border-gray">
        <div class="border-b border-dark-gray">
          <h3 class="contact-title pt-4 px-4 pb-2">
            地図
          </h3>
        </div>

        <div class="pa-2">
          <LazyMap :latitude="shop.latitude" :longitude="shop.longitude" />
        </div>
      </div>
    </div>

    <div v-if="type !== 'top' && posts.length > 0">
      <div class="border-b border-dark-gray">
        <h3 class="contact-title pt-4 px-4 pb-2">
          このお店の記事を見る
        </h3>
      </div>

      <div v-for="post in posts" :key="post.id" class="my-4">
        <nuxt-link :to="`/post/${post.id}`" class="d-flex align-center text-decoration-none">
          <v-img :src="post.image" :alt="`${post.title} - サムネイル - みやメシ.com`" width="120px" />
          <div>
            <h4 class="post-title">
              {{ post.title }}
            </h4>
          </div>
        </nuxt-link>
      </div>
    </div>

    <div v-if="snsLinks.length > 0">
      <div class="border-b border-dark-gray">
        <h3 class="contact-title pt-4 px-4 pb-2">
          各種SNS
        </h3>
      </div>

      <div>
        <SnsIconsShopField :sns-links="snsLinks" />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from '@nuxtjs/composition-api'
import { Post, Shop } from '@/lib'
import { shopToSnsLinks } from '@/src/utils/SnsLinks'

type Props = {
  shop: Shop
  posts: Post[]
  type: 'dish'|'pic'|'contact'|'top'
}
export default defineComponent({
  props: {
    shop: {
      type: Object,
      default: undefined
    },

    posts: {
      type: Array,
      default: () => []
    },

    type: {
      type: String,
      default: 'top'
    }
  },

  setup (props: Props) {
    const snsLinks = computed(() => shopToSnsLinks(props.shop))

    return {
      snsLinks
    }
  }
})
</script>

<style lang="scss" scoped>
.contact-title {
  font-size: 1.25rem;
  font-weight: bolder;
}

.cotact-tel {
  font-size: 1.5rem;
  font-weight: bolder;
}

.post-title {
  font-size: 0.9rem;
  color: #333 !important;
}
</style>
