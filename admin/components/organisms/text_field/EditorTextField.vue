<template>
  <editor
    ref="toastuiEditor"
    :initialValue="valueModel"
    :options="editorOptions"
    height="500px"
    initialEditType="wysiwyg"
    previewStyle="vertical"
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
      editorText: ''
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
  }
}
</script>
