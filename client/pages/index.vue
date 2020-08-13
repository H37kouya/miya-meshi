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
          href: 'https://note.com/miyameshi_ouen/n/nf920b05d1ad2',
          src: '/why_miyameshi-start.png',
          text: '私たちがみやメシ応援隊を始めたわけ。私達には3年間何度も通った飲食店や、お世話になったバイト先がいくつもあります。しかし、昨今の状況でほぼすべてのお店が厳しい状況に陥っており、......',
          hashtag: [
            'みやメシ応援隊',
            'note'
          ]
        },
        {
          href: 'https://note.com/miyameshi_ouen',
          src: '/intro-miyamaeshi.jpg',
          text: '#みやメシ応援隊｜宇都宮にあるテイクアウトできる飲食店を応援します📣｜noteにテイクアウトレポをたくさん載せていきます｜宇大生４人組｜#飲食店の灯りを消さない',
          hashtag: [
            'みやメシ応援隊',
            '飲食店の灯りを消さない'
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
