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

const defaultOptions = {
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
  ]
}

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
      count: 0
    }
  },

  computed: {
    editorOptions: () => defaultOptions,

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
