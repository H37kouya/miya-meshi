<template>
  <div>
    <MainText :level="2">
      各種SNS
    </MainText>

    <div class="u-light-grey-background pt-6 px-2 pb-6">
      <v-row justify="center">
        <template v-for="(snsLink, key) in snsLinks">
          <v-btn
            :key="key"
            :href="snsLink.href"
            target="_blank"
            rel="noopener"
            icon
            x-large
            class="mx-2"
          >
            <v-img :src="snsLink.src" :alt="snsLink.name" aspect-ratio="1" />
          </v-btn>
        </template>
      </v-row>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watchEffect } from '@vue/composition-api'
import { Shop } from '@/lib'

type Props = {
  shop: Shop
}

type SnsLink = {
  name: string,
  href: string,
  src: string
}

enum snsImage {
  facebook = '/s/facebook.png',
  github = '/s/github.png',
  hp = '/s/hp.png',
  instagram = '/s/instagram.png',
  line = '/s/line.png',
  twitter = '/s/twitter.png',
  youtube = '/s/youtube.png',
  uberEats = '/s/UberEats_Badge_Vertical.png'
}

const shopToSnsLinks = (shop: Shop): SnsLink[] => {
  const snsLinks = [] as SnsLink[]
  shop.instaLink && snsLinks.push({ name: 'instagram', href: shop.instaLink, src: snsImage.instagram })
  shop.twitterLink && snsLinks.push({ name: 'twitter', href: shop.twitterLink, src: snsImage.twitter })
  shop.uberEatsLink && snsLinks.push({ name: 'uberEats', href: shop.uberEatsLink, src: snsImage.uberEats })
  shop.homepageLink && snsLinks.push({ name: 'homepage', href: shop.homepageLink, src: snsImage.hp })
  shop.facebookLink && snsLinks.push({ name: 'facebook', href: shop.facebookLink, src: snsImage.facebook })
  shop.lineLink && snsLinks.push({ name: 'line', href: shop.lineLink, src: snsImage.line })
  shop.youtubeLink && snsLinks.push({ name: 'youtube', href: shop.youtubeLink, src: snsImage.youtube })
  return snsLinks
}

export default defineComponent({
  props: {
    shop: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      shop: {} as Shop
    })

    const snsLinks = computed(() => shopToSnsLinks(state.shop))

    watchEffect(() => {
      state.shop = props.shop
    })

    return {
      snsLinks,
      state
    }
  }
})
</script>
