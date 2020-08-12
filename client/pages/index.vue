<template>
  <div>
    <DefaultMainText>
      今週のおすすめ
    </DefaultMainText>

    <div class="u-light-grey-background">
      <v-container>
        <v-row justify="center" class="px-1">
          <template v-for="(menu, key) in list">
            <v-col :key="key" cols="4" md="3" class="px-1">
              <MenuCard v-bind="menu" />
            </v-col>
          </template>
        </v-row>
      </v-container>
    </div>

    <DefaultMainText>
      新着情報
    </DefaultMainText>

    <v-row class="mx-0 mb-4" justify="center">
      <template v-for="(news, key) in newsList">
        <v-col :key="`news${key}`" cols="12" sm="4" md="3" class="px-0 pt-0 px-sm-2">
          <NewsField v-bind="news" />
        </v-col>
      </template>
    </v-row>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@vue/composition-api'

export default defineComponent({
  setup (_, context: SetupContext) {
    const list = computed(() => {
      return [
        {
          name: 'ハンバーグ&チキン',
          price: 976,
          src: '/sample_niku.jpg',
          isTaxIncluded: true
        },
        {
          name: '三種のチーズ牛丼',
          price: 1080,
          src: '/sample_niku.jpg',
          isTaxIncluded: false
        },
        {
          name: 'とろける4種チーズのフォルマッジ',
          price: 976,
          src: '/sample_niku.jpg',
          isTaxIncluded: true
        }
      ]
    })

    const newsList = computed(() => {
      return [
        {
          href: 'https://github.com/H37kouya/miya-meshi',
          src: '/sample_news.jpg',
          text: '宇都宮にはたくさんテイクアウトすることができるお店があります。今回はその中でも、特にあまり知られていない知る人ぞ知る隠れ家店を紹介していきたいと思います。',
          hashtag: [
            '隠れ家',
            'テイクアウト'
          ]
        },
        {
          href: 'https://github.com/H37kouya/miya-meshi',
          src: '/sample_news.jpg',
          text: 'カフェや喫茶店は、テイクアウトという形式を取りづらく日々厳しい状況に追い込まれています。そんな中でも必死に、カフェ&デザートという形でテイクアウトを始めたお店を紹介します。',
          hashtag: [
            '隠れ家',
            'テイクアウト'
          ]
        }
      ]
    })

    return {
      list,
      newsList
    }
  }
})
</script>
