<template>
  <editor
    ref="toastuiEditor"
    :options="editorOptions"
    height="700px"
    initial-edit-type="wysiwyg"
    preview-style="vertical"
    @change="onEditorChange"
  />
</template>

<script>
import 'codemirror/lib/codemirror.css'
import '@toast-ui/editor/dist/toastui-editor.css'
import { Editor } from '@toast-ui/vue-editor'
import Compressor from 'compressorjs'
import { v4 as createUUID } from 'uuid'

export default {
  components: {
    Editor
  },

  props: {
    value: {
      type: String,
      default: ''
    }
  },

  data() {
    return {
      count: 0,
      fileLoading: 0,
      editorOptions: {
        minHeight: '200px',
        language: 'ja',
        useCommandShortcut: true,
        useDefaultHTMLSanitizer: true,
        usageStatistics: false,
        hideModeSwitch: false,
        toolbarItems: [
          'heading',
          'bold',
          'italic',
          'strike',
          'divider',
          'hr',
          'quote',
          'divider',
          'ul',
          'ol',
          'task',
          'indent',
          'outdent',
          'divider',
          'table',
          'image',
          'link',
          'divider',
          'code',
          'codeblock'
        ],
        hooks: {
          addImageBlobHook: (blob, callback) => {
            const uuid = createUUID()
            const storageRef = this.$fireStorage.ref(`upload/selection-post/${uuid}`)
            console.log(blob)
            const payload = {
              quality: 0.8,
              maxWidth: 600,
              maxHeight: 600,
              mimeType: 'image/jpeg',
              success(blob) {
                // ここに成功時の処理を書く。次。
                const uploadTask = storageRef.put(blob)
                uploadTask.on('state_changed',
                  (snapshot) => {
                    // this.fileLoading = (snapshot.bytesTransferred / snapshot.totalBytes) * 100
                  },
                  (err) => {
                    console.log(err)
                  },
                  () => {
                    uploadTask.snapshot.ref.getDownloadURL().then((downloadURL) => {
                      // this.fileLoading = 0
                      // state.thumbnail = downloadURL
                      callback(downloadURL, blob.name || 'みやメシ.com')
                    })
                  }
                )
              },
              error(err) {
                console.log(err.message)
              }
            }

            new Compressor(blob, payload)
          }
        }
      }
    }
  },

  computed: {
    valueModel: {
      get() {
        return this.value
      },
      set(newVal) {
        this.$emit('input', newVal)
      }
    }
  },

  methods: {
    onEditorChange(newVal) {
      this.valueModel = this.$refs.toastuiEditor.invoke('getHtml')
    }
  },

  watch: {
    value() {
      if (this.count < 2) {
        this.$refs.toastuiEditor.invoke('setHtml', this.value)
        this.count++
      }
    }
  }
}
</script>
