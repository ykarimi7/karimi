<template>
  <div>
    <form
      @submit.prevent="submitForm"
      method="post"
      enctype="multipart/form-data"
    >
      <div class="mt-4">
        <file-pond
          name="musicFiles"
          ref="pond"
          label-idle="کلیک برای انتخاب موزیک, یا موزیک را رها کنید..."
          @init="filepondInitialized"
          accepted-file-types="audio/*"
          @processfile="handleProcessedFile"
          max-file-size="10MB"
          allow-multiple="true"
        />
      </div>
      <div class="mt-4">
        <label for="author" class="block text-sm font-medium text-gray-700">
          نام نویسنده
        </label>
        <input
          type="text"
          id="author"
          v-model="author"
          class="mt-1 p-2 border rounded-md w-full"
          required
        />
      </div>
      <div class="mt-8 mb-24">
        <h3 class="text-2xl font-medium text-center">موزیک ها</h3>
        <div class="grid grid-cols-3 gap-2 justify-evenly mt-4">
          <div v-for="(file, index) in files" :key="index">
            <audio :src="'/storage/music/' + file" controls></audio>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">ارسال</button>
    </form>
  </div>
</template>

<script>
import vueFilePond, { setOptions } from 'vue-filepond'
import 'filepond/dist/filepond.min.css'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size'
import axios from 'axios'

let serverMessage = {}

setOptions({
  server: {
    process: {
      url: '/multiple-uploads', // Update to match your Laravel route
      onerror: (response) => {
        serverMessage = JSON.parse(response)
      },
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
          .content,
      },
    },
  },
  labelFileProcessingError: () => {
    return serverMessage.error
  },
})

const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginFileValidateSize,
)

export default {
  components: {
    FilePond,
  },
  data() {
    return {
      files: [],
      author: '',
    }
  },

  methods: {
    filepondInitialized() {
      console.log('Filepond is ready!')
      console.log('Filepond object:', this.$refs.pond)
    },

    handleProcessedFile(error, file) {
      if (error) {
        console.error('File processing error:', error)
      } else {
        console.log('File processed successfully:', file)
        this.files.push(file.serverId)
      }
    },

    submitForm() {
      if (!this.author || this.files.length === 0) {
        console.error('Author name and files are required.')
        return
      }

      const formData = new FormData()
      formData.append('author', this.author)

      for (const file of this.files) {
        formData.append('musicFiles[]', file.file)
      }

      axios
        .post('/multiple-uploads', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
              .content,
          },
        })
        .then((response) => {
          console.log(response.data.message)
          this.files = []
        })
        .catch((error) => {
          console.error(error)
        })
    },
  },
}
</script>
