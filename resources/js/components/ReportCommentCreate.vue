<template>
  <div>
    <form @submit="submitForm">
      <div class="card m-b-30">
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <label>Comment</label>
                  <textarea
                    v-model="form.comment"
                    class="form-control"
                    placeholder="Wrte text here"
                  ></textarea>
                </div>
                <div class="col-md-12 mt-2">
                  <label>Images</label>
                  <vue-dropzone
                    ref="dropzoneRef"
                    :useCustomSlot="true"
                    id="dropzone"
                    :duplicateCheck="true"
                    :options="dropzoneOptions"
                    @vdropzone-removed-file="fileRemoved"
                    @vdropzone-error="errorMessage"
                    @vdropzone-success="uploadSuccess"
                  ></vue-dropzone>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row pb-5 mt-2">
        <div class="col-md-12">
          <button type="submit" name="submit" class="btn btn-success">
            Submit
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  props: ["record"],
  data() {
    return {
      dropzoneOptions: {
        url: route("upload.store"),
        thumbnailWidth: 150,
        maxFilesize: 10,
        addRemoveLinks: true,
        headers: {
          "My-Awesome-Header": "header value",
          "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]')
            .content,
        },
      },
      form: {
        report_id: null,
        comment: "",
        images: [],
      },
    };
  },
  computed: {
    report() {
      return JSON.parse(this.record);
    },
  },
  mounted() {
    this.form.report_id = this.report.id;
    this.form.comment = this.report.site_admin_comment;
    this.report.site_admin_medias.forEach((site_admin_media, key) => {
        this.form.images.push(site_admin_media.media.id);
      let file = {
        size: 123,
        id: site_admin_media.media.id,
        name: site_admin_media.media.name,
        type: "image/png",
      };
      let url = site_admin_media.media.path.thumbnail;
      this.$nextTick(function () {
        this.$refs.dropzoneRef.manuallyAddFile(file, url);
      });
    });
  },
  methods: {
    errorMessage(file, message) {
      showError(message.message);
    },
    submitForm() {
      event.preventDefault();
      axios
        .post(route("report_comment.store"), this.form)
        .then((response) => {
          if (response.data.successMessage) {
            showSuccess(response.data.successMessage);
            setTimeout(() => {
              window.location.replace(
                route("report.index", { successMessage: "Success" })
              );
            }, 1000);
          }
          if (response.data.errorMessage) {
            window.scrollTo(0, 0);
            showError(response.data.errorMessage);
          }
        })
        .catch(function (error) {
          showError(error.message);
        });
    },
    fileRemoved(file) {
      if (file.id) {
        this.removeUploadedFile(file);
      } else {
        this.removeNewUploaded(file);
      }
    },
    removeUploadedFile(file) {
      var position = this.form.images.indexOf(file.id);
      if (position > -1) {
        this.form.images.splice(position, 1);
      }
    },
    removeNewUploaded(file) {
      let media_id = JSON.parse(file.xhr.responseText).upload_id;
      var position = this.form.images.indexOf(media_id);
      if (position > -1) {
        this.form.images.splice(position, 1);
      }
    },
    uploadSuccess(file) {
      let response = JSON.parse(file.xhr.response);
      if (response.successMessage != null) {
        this.form.images.push(response.upload_id);
        showSuccess(response.successMessage);
      }
    },
  },
};
</script>
