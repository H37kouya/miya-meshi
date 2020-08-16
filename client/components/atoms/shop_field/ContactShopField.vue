<template>
  <div>
    <DefaultMainText :level="2">
      お問い合わせ
    </DefaultMainText>

    <div class="u-light-grey-background mb-4">
      <v-container>
        <v-row justify="center">
          <v-col cols="12" class="d-flex justify-center">
            <ContactShopTable :shop="state.shop" />
          </v-col>
        </v-row>

        <v-row justify="center" class="mt-4">
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
      </v-container>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'
import { Shop } from '@/src/types/Shop'

type SnsLink = {
  name: string,
  href: string,
  src: string
}

enum snsImage {
  facebook = '/facebook.png',
  github = '/github.png',
  hp = '/hp.png',
  instagram = '/instagram.png',
  line = '/line.png',
  twitter = '/twitter.png',
  youtube = '/youtube.png'
}

const shopToSnsLinks = (shop: Shop): SnsLink[] => {
  const snsLinks = [] as SnsLink[]
  shop.instaLink && snsLinks.push({ name: 'instagram', href: shop.instaLink, src: snsImage.instagram })
  shop.twitterLink && snsLinks.push({ name: 'twitter', href: shop.twitterLink, src: snsImage.twitter })
  shop.homepageLink && snsLinks.push({ name: 'homepage', href: shop.homepageLink, src: snsImage.hp })
  shop.facebookLink && snsLinks.push({ name: 'facebook', href: shop.facebookLink, src: snsImage.facebook })
  shop.lineLink && snsLinks.push({ name: 'line', href: shop.lineLink, src: snsImage.line })
  shop.youtubeLink && snsLinks.push({ name: 'youtube', href: shop.youtubeLink, src: snsImage.youtube })
  return snsLinks
}

type Props = {
  shop: Shop
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

    watch(() => props.shop, (newVal, _) => {
      state.shop = newVal
    })

    return {
      snsLinks,
      state
    }
  }
})
</script>
