<template>
  <div>
    <div class="mt-4">
      <file-pond
          name="image"
          ref="pond"
          label-idle="کلیک برای انتخاب عکس، یا عکس را رها کنید..."
          @init="filepondInitialized"
          accepted-file-types="image/png,image/jpg,image/jpeg"
          @processfile="handleProcessedFile"
          max-file-size="1MB"
          allow-multiple="true"
      />
    </div>
    <div class="mt-8 mb-24">
      <h3 class="text-2xl font-medium text-center">عکس های گالری</h3>
      <div class="grid grid-cols-3 gap-2 justify-evenly mt-4">
        <div v-for="(image, index) in images" :key="index">
          <img :src="'/storage/images/' + image"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vueFilePond, {setOptions} from 'vue-filepond'
import 'filepond/dist/filepond.min.css'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size'
import axios from 'axios'

let serverMessage = {};

setOptions({
  server: {
    process: {
      url: '/upload',
      onerror: (response) => {
        serverMessage = JSON.parse(response);
      },
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf_token"]').content,
      },
    },
  },

  labelFileProcessingError: () => {
    return serverMessage.error;
  }

})

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginFileValidateSize)

export default {
  components: {
    FilePond,
  },

  data() {
    return {
      images: [],
    }
  },

  mounted() {
    axios
        .get('/images')
        .then((response) => {
          this.images = response.data
        })
        .catch((error) => {
          console.log(error)
        })
  },
  methods: {
    filepondInitialized() {
      console.log('Filepond is ready!')
      console.log('Filepond object:', this.$refs.pond)
    },

    handleProcessedFile(error, file) {
      if (error) {
        console.log(error)
        return
      }

      this.images.unshift(file.serverId)
    },
  },
}
</script>