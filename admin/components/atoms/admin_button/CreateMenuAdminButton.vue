<template>
  <CardButton
    v-bind="$attrs"
    :to="`/menus/create/?shopid=${shopid}`"
    color="light-green lighten-4"
    text="メニュー追加"
    text-color="grey"
    icon="mdi-home"
  />
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import { Shop } from '@/lib'

type Props = {
  shopid: Shop['id']
}

export default defineComponent({
  props: {
    shopid: {
      type: String,
      required: true
    }
  }
})
</script>
