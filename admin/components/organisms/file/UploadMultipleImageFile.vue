<template>
  <v-dialog v-model="state.dialog" scrollable max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="primary" class="ma-5" large v-on="on">
        {{ label }}の設定
      </v-btn>
    </template>
    <v-card>
      <v-card-title>{{ label }}の設定</v-card-title>
      <v-divider />
      <v-progress-linear
        v-model="state.fileLoading"
        stream
      />
      <v-card-text style="height: 400px;">
        <div class="d-flex justify-center mt-4">
          <div>
            <template v-for="(_, key) in pastImageLink">
              <v-btn :key="key" @click="onPageChange(key)" :disabled="key === state.selected" depressed>
                {{ key + 1 }}
              </v-btn>
            </template>
          </div>
        </div>

        <v-card-subtitle>現在の{{ label }}</v-card-subtitle>
        <v-row class="flex-column-reverse flex-sm-row">
          <v-col cols="12" sm="6">
            <v-img
              :src="state.thumbnail[state.selected]"
              :alr="label"
              width="200"
              height="200"
            />
          </v-col>
          <v-col cols="12" sm="6">
            <v-file-input
              accept="image/*"
              label="画像をアップロード"
              @change="onFileUpload"
            />
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script lang="ts">
import { defineComponent, reactive, SetupContext, watch } from '@vue/composition-api'

type Props = {
  defaultImage: string,
  label: string,
  path: string[],
  pastImageLink: string[]
}

export default defineComponent({
  props: {
    defaultImage: {
      type: String,
      default: '/no-image.png'
    },

    label: {
      type: String,
      default: 'サムネイル'
    },

    path: {
      type: Array,
      required: true
    },

    pastImageLink: {
      type: Array,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      fileLoading: 0,
      dialog: false,
      thumbnail: props.pastImageLink,
      selected: 0
    })

    watch(() => props.pastImageLink, (newVal, _) => {
      if (newVal) {
        state.thumbnail = newVal
      }
    })

    const onFileUpload = (file: File) => {
      if (!file) {
        state.thumbnail[state.selected] = props.defaultImage
        context.emit('input', state.thumbnail)
        return
      }

      const storageRef = context.root.$fireStorage.ref(`upload/${props.path[state.selected]}`)
      const uploadTask = storageRef.put(file)
      uploadTask.on('state_changed',
        (snapshot) => {
          state.fileLoading = (snapshot.bytesTransferred / snapshot.totalBytes) * 100
        },
        (err) => {
          console.log(err)
        },
        () => {
          uploadTask.snapshot.ref.getDownloadURL().then((downloadURL: string) => {
            state.fileLoading = 0
            state.thumbnail[state.selected] = downloadURL
            context.emit('input', state.thumbnail)
          })
        }
      )
    }

    const onPageChange = (key: number) => {
      state.selected = key
    }

    return {
      state,
      onFileUpload,
      onPageChange,
      onFileClear
    }
  }
})
</script>
