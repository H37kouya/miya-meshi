<template>
  <div>
    <DefaultMainText>
      今週のおすすめ
    </DefaultMainText>

    <v-container>
      <v-row justify="center">
        <template v-for="(menu, key) in list">
          <v-col :key="key" cols="4" md="3" class="px-1">
            <MenuCard v-bind="menu" />
          </v-col>
        </template>
      </v-row>
    </v-container>

    <DefaultMainText>
      新着情報
    </DefaultMainText>
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

    return {
      list
    }
  }
})
</script>
