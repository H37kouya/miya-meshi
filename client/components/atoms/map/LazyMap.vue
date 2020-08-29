<template>
  <div class="max-width-480">
    <client-only>
      <l-map ref="map" style="height: 320px;" :zoom="zoom" :center="center">
        <l-tile-layer :url="url" />

        <l-marker :lat-lng="center" />
      </l-map>
    </client-only>
  </div>
</template>

<script>
import { defineComponent } from '@vue/composition-api'

export default defineComponent({
  props: {
    latitude: {
      type: Number,
      default: 36.561118
    },

    longitude: {
      type: Number,
      default: 139.882723
    }
  },

  setup (props) {
    return {
      url: 'https://cyberjapandata.gsi.go.jp/xyz/std/{z}/{x}/{y}.png',
      zoom: 15,
      center: [props.latitude, props.longitude]
    }
  }
})
</script>
