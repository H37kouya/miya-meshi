<template>
  <div>
    <DefaultMainText>
      今週のおすすめ
    </DefaultMainText>

    <DefaultMenuList :menus="state.menus" />

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
import { computed, defineComponent, onMounted, reactive, SetupContext } from '@vue/composition-api'
import { Menu } from '~/src/types/Menu'
import { getMenuList } from '~/src/infra/firestore/Menu'

export default defineComponent({
  setup (_, context: SetupContext) {
    const state = reactive({
      menus: [] as Menu[]
    })

    onMounted(async () => {
      state.menus = await getMenuList(context.root.$fireStore, 3)
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
      state,
      newsList
    }
  }
})
</script>
