<template>
  <div>
    <form @submit.prevent="submitForm" method="post" enctype="multipart/form-data">
      <div class="mt-4">
        <file-pond
            name="musics"
            ref="pond"
            label-idle="کلیک برای انتخاب موزیک, یا موزیک را رها کنید..."
            @init="filepondInitialized"
            accepted-file-types="audio/*"
            @processfile="handleProcessedFile"
            max-file-size="10MB"
            allow-multiple="true"
        />
      </div>
      <div class="progress-container">
        <div class="progress-bar" :style="{ width: uploadProgress + '%' }"></div>
      </div>
      <!-- Author input field -->
      <div class="mt-4">
        <label for="author" class="block text-sm font-medium text-gray-700">
          نام نویسنده
        </label>
        <input
            type="text"
            id="author"
            v-model="author"
            class="mt-1 p-2 border rounded-md w-full"
        />
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary">ارسال</button>
    </form>
  </div>
</template>

<script>
import {defineComponent} from "vue";
import vueFilePond, {setOptions} from "vue-filepond";
import "filepond/dist/filepond.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
import axios from "axios";

let serverMessage = {};
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  },
});
setOptions({
  server: {
    process: {
      url: "/multiple-uploads/store",
      onerror: (response) => {
        serverMessage = JSON.parse(response);
      },
      headers: {
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
      },
    },
  },
  labelFileProcessingError: () => {
    return serverMessage.error;
  },
});

// Create FilePond component
const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginFileValidateSize
);

export default defineComponent({
  components: {
    FilePond,
  },
  data() {
    return {
      author: "",
      myFile: [],
      currentUser: window.authUser || null,
      uploadProgress: 0,
    };
  },
  methods: {
    filepondInitialized() {
      console.log("Filepond is ready!");
      Toast.fire({
        icon: "success",
        title: "Filepond is ready",
      });
    },
    handleProcessedFile(error, file) {
      if (error) {
        console.error("File processing error:", error);
        Toast.fire({
          icon: "error",
          title: "Error",
          text: "File processing error: " + error,
        });
      } else {
        this.myFile.push(file.file);
      }
    },
    submitForm() {
      // Submit form data
      if (!this.author || this.myFile.length === 0) {
        Toast.fire({
          icon: "warning",
          title: "warning",
          text: "all fields are required",
        });
        return;
      }

      const formData = new FormData();
      formData.append("author", this.author);
      formData.append('user', this.currentUser);
      this.myFile.forEach((el) => {
        formData.append("musics[]", el);
      });

      axios
          .post("/multiple-uploads/store", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
            onUploadProgress: (progressEvent) => {
              this.uploadProgress = Math.round((progressEvent.loaded / progressEvent.total) * 100);
            },
          })
          .then((response) => {
            // console.log(response.data.message);
            this.myFile = [];
            this.author = "";
            Toast.fire({
              icon: "success",
              title: "success",
              text: response.data.message,
            });
          })
          .catch((error) => {
            console.error(error);
            Toast.fire({
              icon: "error",
              title: "Error",
              text: "An error occurred while submitting the form",
            });
          })
          .finally(() => {
            this.uploadProgress = 0;
          });
    },
  },
});
</script>

<style scoped>
.progress-container {
  width: 100%;
  height: 10px;
  background-color: #eee; /* Background color of the progress container */
  border-radius: 17px;
}

.progress-bar {
  height: 100%;
  background-color: #4ac64a; /* Color of the progress bar */
  transition: width 0.3s ease-in-out; /* Smooth transition effect */
}
.toasted {
  color: white;
  background: #4ac64a;
  font-weight: bold;
}
</style>
