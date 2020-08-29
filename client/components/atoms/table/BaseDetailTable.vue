<template>
  <v-container class="max-width-480">
    <v-row no-gutters class="keyword-row">
      <template v-for="item in list">
        <v-col
          :key="item.id"
          :class="{ 'selected': item.selected }"
          cols="4"
          class="pa-1 keyword-box d-flex justify-center align-center"
          @click="onClick(item.id)"
        >
          <div>{{ item.name }}</div>
        </v-col>
      </template>
    </v-row>

    <p class="mb-0 text-right">
      <a href="https://forms.gle/Yq6x8vKnaKKPYX6eA" target="_blank" rel="noopener" class="other-keyword">
        もし求めてるキーワードがなかったら
      </a>
    </p>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, SetupContext } from '@vue/composition-api'
import { DetailListItem } from '~/components/atoms/table/DetailListItemType'

type Props = {
  list: DetailListItem
}
export default defineComponent({
  props: {
    list: {
      type: Array,
      default: () => []
    }
  },

  setup (_, context: SetupContext) {
    const onClick = (id: string) => context.emit('click', id)

    return {
      onClick
    }
  }
})
</script>

<style lang="scss" scoped>
$border: 1px solid #333;

.keyword-row {
  border-top: $border;
}

.keyword-box {
  border-right: $border;
  border-bottom: $border;
  background-color: #fff;
  font-size: 0.85rem;
  cursor: pointer;
  height: 50px;

  &:nth-child(3n-2) {
    border-left: $border;
  }
}

.selected {
  background-color: rgb(255, 154, 97);
}

.other-keyword {
  color: #6a6a6a;
  font-size: 0.65rem;
}
</style>
