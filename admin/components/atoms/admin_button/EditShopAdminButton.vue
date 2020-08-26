<template>
  <CardButton
    v-bind="$attrs"
    :to="`/shops/${shopid}/edit`"
    color="orange lighten-4"
    text="店舗編集"
    text-color="grey"
    icon="mdi-home"
  />
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import { Shop } from 'miyameshi-lib'

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
