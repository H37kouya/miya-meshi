<template>
  <div class="max-width-480">
    <l-map ref="map" style="height: 320px;" :zoom="zoom" :center="center">
      <l-tile-layer :url="url" />

      <l-marker :lat-lng="center" />
    </l-map>
  </div>
</template>

<script>
import L from 'leaflet'
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet'
import { defineComponent } from '@vue/composition-api'

delete L.Icon.Default.prototype._getIconUrl

L.Icon.Default.mergeOptions({
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
  iconUrl: require('leaflet/dist/images/marker-icon.png'),
  shadowUrl: require('leaflet/dist/images/marker-shadow.png')
})

export default defineComponent({
  components: { LMap, LTileLayer, LMarker },

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
      url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
      zoom: 15,
      center: [props.latitude, props.longitude]
    }
  }
})
</script>
