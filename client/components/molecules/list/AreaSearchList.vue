<template>
  <div>
    <div class="mb-4">
      <div class="mb-2">
        <KeywordMainText>
          現在地
        </KeywordMainText>
      </div>

      <v-list>
        <v-list-item :to="nowAreaLink">
          <v-list-item-content>
            {{ nowArea ? nowArea.name : 'すべて' }}
          </v-list-item-content>

          <v-list-item-action>
            <v-icon>
              mdi-chevron-right
            </v-icon>
          </v-list-item-action>
        </v-list-item>
      </v-list>

      <div class="d-flex justify-end">
        <v-btn color="primary" small text @click="() => this.$emit('update-now-area')">
          現在地を更新
        </v-btn>
      </div>
    </div>

    <div>
      <div class="mb-2">
        <KeywordMainText>
          すべて
        </KeywordMainText>
      </div>

      <v-list>
        <v-list-item
          v-for="(item, key) in listItems"
          :key="key"
          :to="item.to"
        >
          <v-list-item-content>
            {{ item.name }}
          </v-list-item-content>

          <v-list-item-action>
            <v-icon>
              mdi-chevron-right
            </v-icon>
          </v-list-item-action>
        </v-list-item>
      </v-list>

      <p class="mb-0 text-right">
        <a href="https://forms.gle/Yq6x8vKnaKKPYX6eA" target="_blank" rel="noopener" class="other-keyword">
          もし求めてるキーワードがなかったら
        </a>
      </p>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent, SetupContext } from '@nuxtjs/composition-api'
import { Area } from '@/lib'
import { DetailListItemType, DETAIL_LIST_ITEM, DETAIL_LIST_ITEM_LANG } from '@/components/atoms/table/DetailListItemType'

type Props = {
  areas: Area[],
  nowArea: Area,
  selectedIds: string[],
  query?: object
}
export default defineComponent({
  props: {
    areas: {
      type: Array,
      default: () => []
    },

    nowArea: {
      type: Object,
      default: undefined
    },

    selectedIds: {
      type: Array,
      default: () => []
    },

    query: {
      type: Object,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const listItems = computed(() => {
      return [
        {
          id: DETAIL_LIST_ITEM.ALL,
          name: DETAIL_LIST_ITEM_LANG.ALL,
          to: { path: '/shops', query: props.query }
        } as DetailListItemType & { to: string|object },
        ...props.areas.map((area: Area) => ({
          id: area.id,
          name: area.name,
          to: { path: '/shops', query: { areas: area.id, ...props.query }}
        }) as DetailListItemType & { to: string|object })
      ]
    })

    const nowAreaLink = computed(() => {
      return props.nowArea
        ? { path: '/shops', query: { areas: props.nowArea.id, ...props.query } }
        : { path: '/shops', query: { ...props.query } }
    })

    return {
      listItems,
      nowAreaLink
    }
  }
})
</script>

<style lang="scss" scoped>
.other-keyword {
  color: #6a6a6a;
  font-size: 0.65rem;
}
</style>
