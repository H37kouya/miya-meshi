<template>
  <div>
    <v-container class="u-light-grey-background py-2 breadcrumbs-container mb-2">
      <v-breadcrumbs :items="breadcrumbs" class="py-0 px-0 px-sm-6" />
    </v-container>

    <v-container class="py-0 pt-sm-0">
      <v-row>
        <v-col cols="12" md="8" class="px-0 px-md-3 py-0">
          <ShopText id="title">
            みやメシ応援隊とは
          </ShopText>

          <section>
            <ShopText id="p-1" :level="2" class="mb-4">
              お店は、今。抱えるジレンマ
            </ShopText>

            <p class="sentence">
              私達には3年間何度も通った飲食店や、お世話になったバイト先がいくつもあります。しかし、昨今の状況でほぼすべてのお店が厳しい状況に陥っており、昼営業を始めた居酒屋や当面休業を決めたお店もあると聞きました。
            </p>
            <p class="sentence">
              「家にいよう」と盛んに訴えかけられる現在の社会では、飲食店という「密」で、人々の「交流の場」であったお店は敬遠されてしまいがちです。お店側も苦しい状況であるにも関わらず、手放しでお客を呼び込める状況ではない、そんなジレンマを抱えています。
            </p>
          </section>

          <section>
            <ShopText id="p-2" :level="2" class="mb-4">
              おうち時間が増えた。お店はどうなる。
            </ShopText>

            <p class="sentence">
              「おうち時間」が多くなった最近では、私を含め1人暮らしをする多くの人は自炊をしてご飯を食べていることでしょう。私もここにきて料理の腕が上達し、料理のレパートリーが増えました。
            </p>
            <p class="sentence">
              ですが、そんな中でも皆さんは、ふと、思い入れのあるあのお店を気に掛ける時はないですか？
            </p>
            <p class="sentence">
              もし、社会が元の状態に戻った時それらのお店はどうなっているのか。もし、慣れ親しんだあの味や場所が無くなっているのであれば、結局残念な気持ちになるのは私達ではないでしょうか。
            </p>
          </section>

          <section>
            <ShopText id="p-3" :level="2" class="mb-4">
              テイクアウトで「＃みやメシ応援隊」に
            </ShopText>

            <p class="sentence">
              今、営業しているお店の多くはテイクアウトのサービスを始めています。　こんな世の中だからこそ、私達の日常の選択肢に「テイクアウト」という選択があっても良いのではないでしょうか。
            </p>
            <p class="sentence">
              この選択は、お店を応援するためにも、食卓を彩るのにも、人によっては自炊の手間を解消するものとしても有効なものでしょう。
            </p>
            <p class="sentence">
              もちろん毎日とは言いません。人によっては毎日自炊をされている方もいると思います。ですが、このnoteを読んでくださった皆様には「テイクアウト」という選択肢を、頭の片隅に入れて頂きたいのです。
            </p>
            <p class="sentence">
              そのために私たちは周囲の情報をまとめ、発信し皆様により良い選択肢を提供するために努めていきます。もし、見かけた際にはシェアして頂けると幸いです! そして、ぜひ、SNSでこのタグを使い、「＃みやメシ応援隊」になって下さい！！　宇都宮を盛り上げていきましょう！
            </p>
          </section>

          <section>
            <ShopText id="p-4" :level="2" class="mb-4">
              （追記）みやメシ応援隊をやってみて
            </ShopText>

            <p class="sentence">
              みやメシ応援隊を始めて、数日が経過しました。
            </p>
            <p class="sentence">
              たった、数日の間に多くの友達がこの活動を拡散してくれました。お店に掲載許可を頂く説明をした際も、たくさんの応援の言葉を頂きました。
            </p>
            <p class="sentence">
              皆さんそれぞれが思い入れのあるお店に対して、＃みやメシ応援隊としての発信は応援になります。この輪をこれからも広げていきましょう。
            </p>
          </section>
        </v-col>

        <v-col cols="12" md="4" class="px-0 px-md-4 pt-0 pt-md-3">
          <pc-sidebar
            :visible-shop-count="false"
            :news-list="newsList"
          />
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import { defineComponent, useMeta } from '@nuxtjs/composition-api'
import { useNews } from '@/src/CompositonFunctions/news/UseNews'
import { Breadcrumb } from '@/lib'

const breadcrumbs = [
  { exact: true, text: 'Home', to: '/' },
  { text: 'みやメシ応援隊とは', to: '/about/miyameshi' }
] as Breadcrumb[]

export default defineComponent({
  setup () {
    const { newsList } = useNews()

    useMeta({
      title: 'みやメシ応援隊とは',
      meta: [
        {
          hid: 'og:description',
          property: 'og:description',
          content: 'みやメシ応援隊とは。どうしてみやメシ応援隊を始めたのか？私たちの思いを書いています。'
        }
      ]
    })

    return {
      breadcrumbs,
      newsList
    }
  },

  head: {}
})
</script>

<style lang="scss" scoped>
.sentence {
  line-height: 1.8;
  padding: 0 1rem;
}
</style>
