<template>
  <CardButton
    v-bind="$attrs"
    :to="`/admin/menus/${menuid}/edit`"
    color="amber lighten-4"
    text="メニュー編集"
    text-color="grey"
    icon="mdi-home"
  />
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'
import { Menu } from '@/src/types/Menu'

type Props = {
  menuid: Menu['id']
}

export default defineComponent({
  props: {
    menuid: {
      type: String,
      required: true
    }
  }
})
</script>
