<template>
  <v-dialog v-model="state.dialog" scrollable max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="primary" class="ma-5" large v-on="on">
        <v-icon>fas fa-image</v-icon>
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
        <v-card-subtitle>現在の{{ label }}</v-card-subtitle>
        <v-row>
          <v-col cols="4">
            <v-img
              :src="state.thumbnail"
              :alr="label"
              width="200"
              height="200"
            />
          </v-col>
          <v-col cols="8">
            <v-file-input accept="image/*" label="画像をアップロードして設定する。" @change="onFileUpload" />
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, SetupContext, watch } from '@vue/composition-api'

type Props = {
  label: string,
  path: string,
  pastImageLink: string
}

export default defineComponent({
  props: {
    label: {
      type: String,
      default: 'サムネイル'
    },

    path: {
      type: String,
      required: true
    },

    pastImageLink: {
      type: String,
      default: undefined
    }
  },

  setup (props: Props, context: SetupContext) {
    const state = reactive({
      fileLoading: 0,
      dialog: false,
      thumbnail: props.pastImageLink
    })

    watch(() => props.pastImageLink, (newVal, _) => {
      console.log(newVal)
      if (newVal) {
        state.thumbnail = newVal
      }
    })

    const onFileUpload = (file: File) => {
      const storageRef = context.root.$fireStorage.ref(`upload/${props.path}`)
      const uploadTask = storageRef.put(file)
      uploadTask.on('state_changed',
        (snapshot) => {
          state.fileLoading = (snapshot.bytesTransferred / snapshot.totalBytes) * 100
        },
        (err) => {
          console.log(err)
        },
        () => {
          uploadTask.snapshot.ref.getDownloadURL().then((downloadURL) => {
            state.fileLoading = 0
            state.thumbnail = downloadURL
            context.emit('input', state.thumbnail)
          })
        }
      )
    }

    return {
      state,
      onFileUpload
    }
  }
})
</script>
