<template>
  <v-card
    v-bind="$attrs"
    class="d-flex align-center justify-center"
    height="120px"
    link
  >
    <div class="text-center">
      <v-icon v-if="icon" icon large :color="textColor === 'white' ? '#fff': undefined">
        {{ icon }}
      </v-icon>

      <p
        class="card-button-text"
        :class="{
          'white--text': textColor === 'white',
          'admin--text': textColor === 'grey'
        }"
      >
        {{ text }}
      </p>
    </div>
  </v-card>
</template>

<script lang="ts">
import { defineComponent } from '@vue/composition-api'

type Props = {
  color?: string,
  icon?: string
  text?: string,
  textColor?: 'grey'|'white',
  to?: string
}

export default defineComponent({
  props: {
    icon: {
      type: String,
      default: undefined
    },

    text: {
      type: String,
      required: true
    },

    textColor: {
      type: String,
      default: 'grey',
      validator (v: string) {
        return ['white', 'grey'].includes(v)
      }
    }
  }
})
</script>

<style lang="scss" scoped>
.card-button-text {
  font-size: 1.25rem;
  margin-bottom: 0;
}

.admin--text {
  color: $admin-text-color;
}
</style>
